<?php

namespace App\Helpers;


class APIFormatter
{
    protected static $response = [
        'status' => null,
        'message' => null,
        'data' => null,
    ];

    public static function responseAPI($code = null, $message = null, $data = null, $error = null, $customename = null, $customvalue = null)
    {
        $status = 1;
        // switch ($code) {
        //     case 200:
        //         $status = "success";
        //         // $message="The request has succeeded";
        //         break;
        //     case 201:
        //         $status = "success";
        //         $message = "Success Created";
        //         break;
        //     case 202:
        //         $status = "success";
        //         $message = "The request has been accepted for processing";
        //         break;
        //     case 400:
        //         $status = "error";
        //         $message = "Bad Request";
        //         break;
        //     case 401:
        //         $status = "error";
        //         $message = "Unauthorized";
        //         break;
        //     default:
        //         $status = "error";
        // }

        // dd($status);

        self::$response['status'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        if ($error) {
            self::$response['error'] = $error;
        }
        if ($customename) {
            self::$response[$customename] = $customvalue;
        }

        return response()->json(self::$response, $code);
    }
}

function send_notification_FCM($notification_id, $title, $message, $id, $type)
{

    $accesstoken = env('FCM_KEY');

    $URL = 'https://fcm.googleapis.com/fcm/send';


    $post_data = '{
            "to" : "' . $notification_id . '",
            "data" : {
              "body" : "",
              "title" : "' . $title . '",
              "type" : "' . $type . '",
              "id" : "' . $id . '",
              "message" : "' . $message . '",
            },
            "notification" : {
                 "body" : "' . $message . '",
                 "title" : "' . $title . '",
                  "type" : "' . $type . '",
                 "id" : "' . $id . '",
                 "message" : "' . $message . '",
                "icon" : "new",
                "sound" : "default"
                },
 
          }';
    // print_r($post_data);die;

    $crl = curl_init();

    $headr = array();
    $headr[] = 'Content-type: application/json';
    $headr[] = 'Authorization: ' . $accesstoken;
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($crl, CURLOPT_URL, $URL);
    curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

    $rest = curl_exec($crl);

    if ($rest === false) {
        // throw new Exception('Curl error: ' . curl_error($crl));
        //print_r('Curl error: ' . curl_error($crl));
        $result_noti = 0;
    } else {

        $result_noti = 1;
    }

    //curl_close($crl);
    //print_r($result_noti);die;
    return $result_noti;
}
