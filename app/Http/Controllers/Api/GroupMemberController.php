<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Helpers\Notify;
use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth('sanctum')->user()->id;
        $data = GroupMember::where('user_id', $id)->get();
        if ($data) {
            return APIFormatter::responseAPI(201, 'Request Success', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'group_id' => 'required',
            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $user_id = auth('sanctum')->user()->id;
            $check = GroupMember::where('user_id', '=', $user_id)
                ->where('group_id', '=', $request->group_id)->orderBy('created_at', 'DESC')->first();
            // ->sortKeysDesc()->first();

            // dd($check->approved_at);

            if ($check) {

                if ($check->approved_at == null) {

                    return APIFormatter::responseAPI(400, 'failed');
                } elseif ($check->leave_at == null) {
                    # code...
                    if ($check->complete_at  == null) {
                        # code...
                        return APIFormatter::responseAPI(400, 'failed');
                    }
                    // dd('tambah');
                    $data = GroupMember::create([
                        'user_id' => $user_id,
                        'group_id' => $request->group_id
                    ]);
                    if ($data) {
                        Notify::joingroup($user_id, $request->group_id);
                        return APIFormatter::responseAPI(201, 'Request Success', $data);
                    } else {
                        return APIFormatter::responseAPI(400, 'failed');
                    }
                } elseif ($check->complete_at  == null) {
                    if ($check->leave_at  == null) {
                        # code...
                        return APIFormatter::responseAPI(400, 'failed');
                    }
                    // dd(3);
                    $data = GroupMember::create([
                        'user_id' => $user_id,
                        'group_id' => $request->group_id
                    ]);
                    if ($data) {
                        Notify::joingroup($user_id, $request->group_id);
                        return APIFormatter::responseAPI(201, 'Request Success', $data);
                    } else {
                        return APIFormatter::responseAPI(400, 'failed');
                    }
                }
            }
            // $check->where("complete_at", '!=', null)->get();


            // $data = $check;
            $data = GroupMember::create([
                'user_id' => $user_id,
                'group_id' => $request->group_id
            ]);
            if ($data) {
                return APIFormatter::responseAPI(201, 'Request Success', $data);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
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
        //
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
    public function update(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'reason_leave' => 'required',
            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $check = GroupMember::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'DESC')->first();

            $check->reason_leave = $request->reason_leave;

            $check->save();
            $data = $check;
            if ($data) {
                return APIFormatter::responseAPI(200, 'Request success', $data);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }

    public function transfer(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'tranfer' => 'required',
            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $check = GroupMember::where('user_id', '=', $user_id)
                ->orderBy('created_at', 'DESC')->first();

            $check->transfer = $request->transfer;

            $check->save();

            // $check->update([
            //     'reason_leave' => $request->reason_leave
            // ]);
            // $freshFlight = $check->fresh();

            // dd($check);
            $data = $check;
            if ($data) {
                return APIFormatter::responseAPI(200, 'Request success', $data);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
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
}
