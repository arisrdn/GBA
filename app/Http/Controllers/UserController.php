<?php

namespace App\Http\Controllers;

use App\Helpers\APIFormatter;
use App\Models\CountryCode;
use App\Models\Group;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = User::where("role_id", "!=", "2")->get();
        return view("admin.user", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = CountryCode::all();
        $province = Province::all();
        $role = Role::where("name", "!=", "user")->get();
        return view("admin.user-add", compact("province", "country", "role"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            'whatsapp_no' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'regency' => 'required',
            'role' => 'required',

        ]);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        ////upload to public 
        if ($file = $request->file('photo_profile')) {
            $name = 'photo-' . time() . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
            $path = $file->move(public_path('images/users/'), $name);
            $path = "/images/users/" . $name;
        }
        // dd($path);
        $password =  substr(str_shuffle($permitted_chars), 0, 8);


        //store file into  db
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'whatsapp_no' => $request->whatsapp_no,
            'gender' => $request->gender,
            'address' => $request->address,
            'birth_date' => $request->birth_date,

            'country_id' => $request->phone_code,
            'church_branch_id' => $request->church_branch_id,
            'regency_id' => $request->regency,
            'role_id' => 2,
        ]);
        $data = User::where('email', $data['email'])->with('church_branch', 'country')->firstOrFail();

        if ($data) {
            return back()->with('success', 'Data Berhasil Di Tambah');
        } else {
            return back()->with('error', 'Data Gagal Di Tambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('church_branch', 'country')->find($id);
        $data['photo_path'] =  asset('images/users/') . $data->photo_profile;
        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }

    public function showg($id)
    {
        $data = Group::find($id);
        $data->photo_profile =  null;
        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function test($id)
    {
        //
        $data = User::whereHas('group', function ($q1) use ($id) {
            $q1->where('group_id', $id);
        })
            ->pluck('device_token')->toArray();
        $data2 = User::whereHas('adminGroup', function ($q1) use ($id) {
            $q1->where('group_id', $id);
        })
            ->pluck('device_token')->toArray();
        $tokens = array_merge($data, $data2);

        return APIFormatter::responseAPI(200, 'The request has succeeded', $tokens);
    }
}
