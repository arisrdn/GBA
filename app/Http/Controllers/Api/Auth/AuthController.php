<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Message;
use App\Helpers\Notify;
use App\Notifications\ApiEmailVerified;
use App\Notifications\User\GlobalNotification;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp_no' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'photo_profile' => 'required',
            'country_id' => 'required',
            'church_branch_id' => 'required',
            'regency_id' => 'required',
            // 'device_token' => 'required',
            // 'role_id' => 'required',
        ]);
        if ($validator->fails()) {
            return APIFormatter::responseAPI(422, 'Validation Failed ', null, $validator->errors());
        }

        ////upload to public 
        if ($file = $request->file('photo_profile')) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $name = 'photo-' . time() . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
            $path = $file->move(public_path('images/users/'), $name);
            $path = "/images/users/" . $name;
        }
        // dd($path);
        try {

            //store file into  db
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'whatsapp_no' => $request->whatsapp_no,
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'photo_profile' => $name,
                'country_id' => $request->country_id,
                'church_branch_id' => $request->church_branch_id,
                'regency_id' => $request->regency_id,
                'role_id' => 2,
            ]);
            $user = User::where('email', $data['email'])->with('church_branch', 'country')->firstOrFail();
            $user['photo_path'] =  asset('images/users/') . $user->photo_profile;
            // $data->sendEmailVerificationNotification();
            $data->notify(new ApiEmailVerified());
            $data->notify(new GlobalNotification(Message::REGISTER));
            Notify::GlobalUserNotify(Message::REGISTER);


            $token = $user->createToken(env("TOKEN_SANCTUM"))->plainTextToken;
            return APIFormatter::responseAPI(201, 'Register Success ', $user, null, 'token', $token);
        } catch (Exception $err) {
            //throw $th;
            $file_path = public_path('images/users/') . $name;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }

    public function login(Request $request)
    {
        // dd(asset('images/my-logo.png') );
        if (!Auth::attempt($request->only('email', 'password'))) {
            return APIFormatter::responseAPI(400, 'Login Failed', null, 'incorrect username or password');
        }

        $user = User::where('email', $request['email'])->with('church_branch', 'country')->firstOrFail();
        $user['photo_path'] =  asset('images/users/') . $user->photo_profile;

        $token = $user->createToken(env("TOKEN_SANCTUM"))->plainTextToken;

        return APIFormatter::responseAPI(200, 'success login', $user, null, 'token', $token);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
