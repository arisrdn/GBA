<?php

namespace App\Http\Controllers\Api;

use App\ApiCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ApiEmailVerified;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Verified;
class VerificationController extends Controller {

//     // public function __construct() {
//     //     $this->middleware('auth:api')->except(['verify']);
//     // }

//     /**
//      * Verify email
//      *
//      * @param $user_id
//      * @param Request $request
//      * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//      */
//     public function verify($user_id, Request $request) {
//         // if (! $request->hasValidSignature()) {
//         //     return $this->authorizeResource(201);
//         // }

//         if (!$request->hasValidSignature()) {
//             return response()->json(["msg" => "Invalid/Expired url provided."], 401);
//         }
//         $user = User::findOrFail($user_id);

//         if (!$user->hasVerifiedEmail()) {
//             $user->markEmailAsVerified();
//         }

//         return view('verify_success');
//     }

//     /**
//      * Resend email verification link
//      *
//      * @return \Symfony\Component\HttpFoundation\Response
//      */
//     public function resends() {

//         dd(3);
//         // if (auth()->user()->hasVerifiedEmail()) {
//         //     return $this->respondBadRequest(200);
//         // }

//         // auth()->user()->sendEmailVerificationNotification();

//         // return $this->respondWithMessage("Email verification link sent on your email id");
//     }



public function verify($id) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
        // dd(request()->wantsJson());
        return request()->wantsJson()
            ? new JsonResponse('', 204)
            : view('verify_success');
    }
    return request()->wantsJson()
        ? new JsonResponse('', 204)
        : dd('Sudah di verivikasi');
}

public function resend() {
    $data= request()->user();
    $data->notify(new ApiEmailVerified());
    return response([
        'data' => [
            'message' => 'Request has been sent!',
        ]
    ]);
}
}



