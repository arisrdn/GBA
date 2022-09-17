<?php

namespace App\Helpers;

use App\Models\Group;
use App\Models\User;
use App\Notifications\User\GlobalNotification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;

class Notify
{
    public static function notifyadmin($sendername, $header, $message)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($header);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "a_registration_from_your_database";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }


    public static function joingroup($user_id)
    {
        $message = Message::JOINGROUP;
        $user = User::find($user_id);
        $user->notify(new GlobalNotification($message));
        $admin = User::where("role_id", 1)->get();

        foreach ($admin as $key => $value) {
            # code...
            $value->notify(new GlobalNotification($message));
        }

        $header = "Permintaam masuk group";
        $message =  $user->name . "Meminta Bergaabung Ke Group ";
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($header);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $tokens = $admin->pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }

    public static function GlobalUserNotify($data)
    {
        $header = $data["header"];
        $message = $data["body"];
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($header);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "fEEOW8ZxSoGGiMx7dhYmIZ:APA91bGABhNyeByEDBOSiTwtABGdeNXNXmOnN7agPbijsRl9Jz98ewOJXuR913DlOCPnMGgJZoSC5OZxdN5yJyerl5zy_pRRnJMjowp6uZo9uxii7S5n6sLJKeZWPXoUhz9dOEqLZPlc";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }

    // ok
    public function messagePersonal($sendername, $message, $toid)
    {
        $user = User::find($toid);
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message, "tp" => "message"]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $token = $user->pluck('device_token')->toArray();
        $token = "fldkaf9kHCFCLiEHnaaQCv:APA91bHIUNyZqk6_xky1oodkoWqXvdaZWtoV7YZ4WiPcCt2uUlEq_Cwl2IgSaAb4TiCher4UoBk4kH_3W73tITmxxvmVomqmNipsOIYWnIUMyIhEUa76_doMxxdgRDpjflWPPjEpmFdV";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }

    // notify message group ok
    public static function messageGroup($sendername, $message, $id)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            // ->setImage('http://example.com/url-to-image-here.png')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message, "tp" => "message"]);
        // $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $usr = User::whereHas('group', function ($q1) use ($id) {
            $q1->where('group_id', $id);
        })
            ->pluck('device_token')->toArray();
        $usr2 = User::whereHas('adminGroup', function ($q1) use ($id) {
            $q1->where('group_id', $id);
        })
            ->pluck('device_token')->toArray();
        $tokens = array_merge($usr, $usr2);
        // $tokens = User::pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
    // notify message person ok
    public static function messagePerson($sendername, $message, $id)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            // ->setImage('http://example.com/url-to-image-here.png')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message, "tp" => "message"]);
        // $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $usr = User::find($id)
            ->pluck('device_token')->toArray();

        $tokens =  $usr;
        // $tokens = User::pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
    public static function messageBC($sendername, $message, $id)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('message from ' . $sendername);
        $notificationBuilder->setBody($message)
            // ->setImage('http://example.com/url-to-image-here.png')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);
        // $dataBuilder->addData(['sender_name' => $sendername, 'message' => $message]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $usr = User::find($id)
        //     ->pluck('device_token')->toArray();
        $user = User::where("id", "!=", $id)->pluck('device_token')->toArray();

        if ($id == "member") {
            $user = User::where("id", "!=", $id)->where("role_id", 2)->pluck('device_token')->toArray();
            # code...

        } elseif ($id == "member") {
            $user = User::where("id", "!=", $id)->where("role_id", "!=", 2)->pluck('device_token')->toArray();
        }

        $tokens =  $user;
        // $tokens = User::pluck('device_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
}
