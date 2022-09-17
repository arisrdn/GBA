<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Helpers\Notify;
use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use App\Models\WaitingList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaitingListController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function join(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'plan' => 'required',
                'read_option' => 'required',
            ]);
            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $dt = [
                'read_option' => $request->read_option,

            ];
            $data = WaitingList::create([
                'user_id' => $user_id,
                'type' => "join",
                'data' => json_encode($dt),
                'group_plan_id' => $request->plan,
            ]);
            if ($data) {
                Notify::joingroup($user_id);
                return APIFormatter::responseAPI(200, 'Request success', $dt);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
    public function leave(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'reason_leave' => 'required',
                'note' => 'required',
            ]);
            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $dt = array('note' => $request->note);
            // $dt = [
            //     'note' => $request->note,

            // ];
            $data = WaitingList::create([
                'user_id' => $user_id,
                'type' => "leave",
                'data' => json_encode($dt),
                'reason_leave_id' => $request->reason_leave,
            ]);
            if ($data) {
                return APIFormatter::responseAPI(200, 'Request success', $dt);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
    public function transfer(Request $request)
    {
        try {
            $user_id = auth('sanctum')->user()->id;
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'transfer' => 'required',

            ]);
            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $dt = [
                'transfer' => $request->transfer,

            ];
            $data = WaitingList::create([
                'user_id' => $user_id,
                'type' => "transfer",
                'data' => json_encode($dt),
            ]);
            if ($data) {
                return APIFormatter::responseAPI(200, 'Request success', $dt);
            } else {
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
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
