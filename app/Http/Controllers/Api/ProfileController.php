<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth('sanctum')->user()->id;

        $data = User::with('church_branch', 'country')->find($id);
        // dd($data);
        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }


    public function changepassword(Request $request)
    {
        try {
            $id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|string|min:8|confirmed'
            ]);
            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'Validation Failed ', null, $validator->errors());
            }

            $data = User::find($id);
            if (Hash::check($request->old_password, $data->password)) {
                $data->fill([
                    'password' => Hash::make($request->password)
                ])->save();
                return APIFormatter::responseAPI(200, 'Password changed');
                return redirect()->route('your.route');
            } else {
                return APIFormatter::responseAPI(422, 'Old Password does not match');
            }
        } catch (Exception $err) {
            //throw $th;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
    public function update(Request $request)
    {
        // $username = Input::get('name');
        // dd($request);
        $id = auth('sanctum')->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'whatsapp_no' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'country_id' => 'required',
            'church_branch_id' => 'required',
        ]);
        if ($validator->fails()) {
            return APIFormatter::responseAPI(422, 'Validation Failed ', null, $validator->errors());
        }

        try {

            //update file into  db
            $data = User::findOrFail($id);

            ////upload to public 


            if ($file = $request->file('photo_profile')) {

                if ($data->photo_profile) {
                    $file_path = public_path('images/users/') . $data->photo_profile;
                    if (File::exists($file_path)) {
                        unlink($file_path);
                    }
                }

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $name = 'photo-' . time() . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
                $path = $file->move(public_path('images/users/'), $name);
            }
            $data->update([
                'name' => $request->name,
                'whatsapp_no' => $request->whatsapp_no,
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'photo_profile' => $name,
                'country_id' => $request->country_id,
                'church_branch_id' => $request->church_branch_id,
                'role_id' => 2,
            ]);
            $user = User::where('email', $data['email'])->with('church_branch', 'country')->firstOrFail();
            $user['photo_path'] =  public_path('images/users/') . $user->photo_profile;

            return APIFormatter::responseAPI(200, 'success update', $user);
        } catch (Exception $err) {
            //throw $th;
            $file_path = public_path('images/users/') . $name;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storetoken(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $user = User::find($user_id)->first();
            $user->device_token = $request->token;
            $user->save();
            // Auth::user()->update(['device_token' => $request->token]);
            // auth()->user()->update
            // return response()->json(['Token successfully stored.']);

            $data = $user;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'Token successfully stored',);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            throw $err;
            // dd($err);
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
}
