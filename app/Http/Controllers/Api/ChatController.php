<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth('sanctum')->user()->id;
        $data = User::whereHas('haschats', function ($q1) use ($id) {
            $q1->where('to_id', $id)
                ->select('id', 'name');
        })->get(['id', 'name']);

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
        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = Chat::create([
            'from_id' => auth()->user()->id,
            'to_id' => $request->to_id,
            'message' => $request->message
        ]);

        $this->broadcashmessage(auth()->user()->name, $request->message);

        return APIFormatter::responseAPI(201, 'Success Created', $chat);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Chat::where("to_id", $id)
            ->where('from_id', auth()->user()->id)
            ->orWhere(function ($query) use ($id) {
                $query->where('to_id', '=', auth()->user()->id);
                $query->where('from_id', '=', $id);
            })->get();
        // dd($data2);

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function broadcashmessage($sendername, $message)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
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
    public function personalhmessage($sendername, $message, $token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "a_registration_from_your_database";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
}
