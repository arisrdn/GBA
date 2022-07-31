<?php

namespace App\Helpers;


class APIFormatter{
    protected static $response = [
        'status'=>null,
        'message'=>null,
        'data'=>null,
    ];

    public static function responseAPI($code =null,$message=null,$data=null ,$error=null,$customename=null,$customvalue=null)
    {
        $status=1;
        switch($code){
            case 200:
                $status="success";
                // $message="The request has succeeded";
                break;
            case 201:
                $status="success";
                $message="Success Created";
                break;
            case 202:
                $status="success";
                $message="The request has been accepted for processing";
                break;
            case 400:
                $status="error";
                $message="Bad Request";
                break;
            case 401:
                $status="error";
                $message="Unauthorized";
                break;
            default:
            $status="error";

        }
        
        // dd($status);

        self::$response['status']=$status;
        self::$response['message']=$message;
        self::$response['data']=$data;
        if ($error) {
            self::$response['error']=$error;
        }
        if ($customename) {
            self::$response[$customename]=$customvalue;
        }

        return response()->json(self::$response,$code);
    }

 
}

