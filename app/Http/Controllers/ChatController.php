<?php

namespace App\Http\Controllers;

use App\Helpers\APIFormatter;
use App\Models\Chat;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;

class ChatController extends Controller
{
    //
    public function createmessage(Request $request)
    {
        // return $request;
        // dd($request);
        $chat = Chat::create([
            'from_id' => auth()->user()->id,
            'to_id' => $request->to_id,
            'message' => $request->message
        ]);

        $this->broadcashmessage(auth()->user()->name, $request->message);

        return APIFormatter::responseAPI(201, 'Success Created',);
    }

    public function update()
    {
        $data = User::all();
        $data2 = Chat::all();
        $data3 = Group::all();
        // dd($data2);
        // foreach ($data as $key) {
        //     # code...
        //     // dd($key->member2());
        //     dd($key->group->name);
        // }
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
            })->get();
        // dd($data2);

        return View::make("layouts.partials.chat")
            ->with('data2', $data2)
            ->render();
    }

    public function broadcashmessage($sendername, $message)


    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            // ->setImage('http://example.com/url-to-image-here.png')
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
