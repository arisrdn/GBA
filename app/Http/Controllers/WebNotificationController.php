<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;

class WebNotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }

    public function storeToken(Request $request)
    {
        // return response()->json(auth());

        // dd(auth());
        Auth::user()->update(['device_token' => $request->token]);
        // auth()->user()->update
        return response()->json(['Token successfully stored.']);
    }

    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        // $FcmToken = ["cbF3HrSqB1iVe6kj7XRzz0:APA91bHeAIWwZbwvT9hpNSbjphRshlRZ2mrbqHN4BiTvoiO-yjGBpAxIzcU9yWMvwYmz0T-7-VFEhFMMKSGIwsKDMc4q4VS0dJPOUdvUCV50zpXLcjM3hQNRxhlBuH6Ya9LcFMm0_bYV", "fw8QCcBAgmODPsqtBcMm4n:APA91bGlT-QY9yHS6L1s5oIT68jhg6qxsHHWRI_lAyO-Nfh90V4EXxywr9lHHvP-fkbBr28hGPqEK1TZkkbyrJBhHe9A-2DX3lanQy0LhRJ35NKQsFLqLMTN3Rbr_R9BFlyqJic58xHL"];
        $FcmToken = ["fw8QCcBAgmODPsqtBcMm4n:APA91bGlT-QY9yHS6L1s5oIT68jhg6qxsHHWRI_lAyO-Nfh90V4EXxywr9lHHvP-fkbBr28hGPqEK1TZkkbyrJBhHe9A-2DX3lanQy0LhRJ35NKQsFLqLMTN3Rbr_R9BFlyqJic58xHL"];
        // dd($FcmToken);

        // $serverKey = 'BCTiSuRkN71sKQaXyYmufcNi0RqcZec-TODF7RHnLmnHGGTNdquvG4LtWX4TtZk9utfOKujQqMY2Nm3UwuGoav0';
        $serverKey = 'AAAADO5kgwo:APA91bEHw2q4e7eRFhXIny9-pdtG-pb_3EhwRv5ZxWkr38avkwCufhNaf82KluE12lvhSvXMW9xrxODAZCz9dC7keT8iPtQiImKGPZPnUMFI2jlPOsbOF2KDVR4z0FgLzmCJRYz4vpEt';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $encodedData = json_encode($data);

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $token = "cbF3HrSqB1iVe6kj7XRzz0:APA91bHeAIWwZbwvT9hpNSbjphRshlRZ2mrbqHN4BiTvoiO-yjGBpAxIzcU9yWMvwYmz0T-7-VFEhFMMKSGIwsKDMc4q4VS0dJPOUdvUCV50zpXLcjM3hQNRxhlBuH6Ya9LcFMm0_bYV";
        // $token = "fw8QCcBAgmODPsqtBcMm4n:APA91bGlT-QY9yHS6L1s5oIT68jhg6qxsHHWRI_lAyO-Nfh90V4EXxywr9lHHvP-fkbBr28hGPqEK1TZkkbyrJBhHe9A-2DX3lanQy0LhRJ35NKQsFLqLMTN3Rbr_R9BFlyqJic58xHL";
        // You must change it to get your tokens
        $tokens = User::whereNotNull('device_token')->pluck('device_token')->all();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        // $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        dd($downstreamResponse);
        // $headers = [
        //     'Authorization:key=' . $serverKey,
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // // Disabling SSL Certificate support temporarly
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // // Execute post
        // $result = curl_exec($ch);
        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // // Close connection
        // curl_close($ch);
        // // FCM response
        // dd($result);
    }
}
