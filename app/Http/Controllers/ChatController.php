<?php

namespace App\Http\Controllers;

use App\Helpers\APIFormatter;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupChat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use App\Helpers\Notify;

class ChatController extends Controller
{
    //
    public function storep(Request $request)
    {

        try {


            $validator = Validator::make($request->all(), [
                'to_id' => "required",
                'message' => "required"
            ]);

            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $id = auth()->user()->id;

            $data = Chat::create([
                'from_id' => auth()->user()->id,
                'to_id' => $request->to_id,
                'message' => $request->message
            ]);

            if ($data) {

                Notify::messagePerson(auth()->user()->name, $request->message, $request->to_id);
                // $this->broadcashmessage(auth()->user()->name, $request->message);

                return APIFormatter::responseAPI(201, 'Success Created',);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
    public function storeg(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                "to_id" => "required",
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $id = auth()->user()->id;

            $data = GroupChat::create([
                'message' => $request->message,
                'group_id' => $request->to_id,
                'from_id' => $id
            ]);

            if ($data) {
                # code...
                Notify::messageGroup(auth()->user()->name, $request->message, $request->to_id);
                // $this->broadcashmessage(auth()->user()->name, $request->message);

                return APIFormatter::responseAPI(201, 'Success Created', $data);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }

    public function update()
    {
        $data = User::all();
        $data2 = Chat::all();
        $data3 = Group::all();
        return view('admin.chat')->with('data1', $data,)->with('data2', $data2,)->with('data3', $data3);;
    }

    public function loadmessage(Request $request)
    {

        // return $request;
        // dd($request->data);
        // $data2 = Chat::all();
        $data2 = Chat::where("to_id", $request->id)
            ->where('from_id', auth()->user()->id)
            ->orWhere(function ($query) use ($request) {
                $query->where('to_id', '=', auth()->user()->id);
                $query->where('from_id', '=', $request->id);
            })->with(["sender", "to"])->get();
        // dd($data2);

        return View::make("layouts.partials.chat")
            ->with('data2', $data2)
            ->render();
    }

    public function contact()
    {
        # code...
        $data = User::where("id", "!=", auth()->user()->id)->get();
        $i = 0;
        foreach ($data as $value) {
            $data[$i]->last_chat = Chat::where("to_id", $value->id)
                ->where('from_id', auth()->user()->id)
                ->orWhere(function ($query) use ($value) {
                    $query->where('to_id', '=', auth()->user()->id);
                    $query->where('from_id', '=', $value->id);
                })->orderBy('created_at', 'DESC')->first();
            $i++;
        }
        return APIFormatter::responseAPI(201, 'Request Success', $data);
    }
    public function group()
    {
        # code...
        $id = auth()->user()->id;
        $data = Group::
            // ->with('lastChat')
            get(['id', 'name']);

        $i = 0;
        foreach ($data as $value) {
            $data[$i]->last_chat = GroupChat::where("group_id", $value->id)

                ->orderBy('created_at', 'DESC')->first();
            $i++;
        }
        if ($data) {
            return APIFormatter::responseAPI(201, 'Request Success', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    public function message($id)
    {
        $data = Chat::where("to_id", $id)
            ->where('from_id', auth()->user()->id)
            ->orWhere(function ($query) use ($id) {
                $query->where('to_id', '=', auth()->user()->id);
                $query->where('from_id', '=', $id);
            })->with("sender", "to")->get();



        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    public function messageGroup($id)
    {
        $data = GroupChat::where("group_id", $id)
            ->with("sender")->get();

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        $i = 0;


        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }


    public function broadcast()
    {
        return view('admin.broadcast');
    }

    public function broadcaststore(Request $request)
    {

        try {
            // dd($request);


            $validator = Validator::make($request->all(), [
                'to' => "required",
                'message' => "required"
            ]);

            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $id = auth()->user()->id;
            $user = User::where("id", "!=", $id)->get();

            if ($request->to == "member") {
                $user = User::where("id", "!=", $id)->where("role_id", 2)->get();
                # code...

            } elseif ($request->to == "member") {
                $user = User::where("id", "!=", $id)->where("role_id", "!=", 2)->get();
            }

            foreach ($user as $key => $value) {
                $data = Chat::create([
                    'from_id' => auth()->user()->id,
                    'to_id' => $value->id,
                    'message' => $request->message
                ]);
            }


            if ($data) {

                Notify::messageBC(auth()->user()->name, $request->message, $request->to);
                return back()->with('success', 'Pesan Berhasil Di kirim');
            } else {
                return back()->with('error', 'Terjadi Kesalahan');
            }
        } catch (Exception $err) {
            // throw $err;
            return back()->with('error', 'Terjadi Lesalahan');
        }
    }






    public function broadcashmessage($sendername, $message)

    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            ->setImage('https://gba.test/logo-GBA.png')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // You must change it to get your tokens
        $tokens = User::pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
}
