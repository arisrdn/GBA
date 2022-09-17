<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;


class ForgotPasswordController extends Controller
{
    //
    protected function sendResetLinkResponse(Request $request)
    {
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return APIFormatter::responseAPI(422, 'The request has succeeded', null, $validator->errors());
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $response =  Password::sendResetLink($input);
        if ($response == Password::RESET_LINK_SENT) {
            return APIFormatter::responseAPI(200, 'Mail send successfully', null,);
        } else {
            $message = "Email could not be sent to this email address";
            return APIFormatter::responseAPI(400, $message, null,);
        }
        //$message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : GLOBAL_SOMETHING_WANTS_TO_WRONG;

    }
}
