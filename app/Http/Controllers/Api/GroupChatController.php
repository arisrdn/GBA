<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupChat;
use App\Models\GroupMember;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GroupChatController extends Controller
{
    //
    public function index()
    {
        $id = auth('sanctum')->user()->id;
        $data = Group::whereHas('user', function ($q1) use ($id) {
            $q1->where('user_id', $id);
            // ->select('id', 'name');
        })
            // ->with('lastChat')
            ->get(['id', 'name']);

        $i = 0;
        foreach ($data as $value) {
            $data[$i]->last_chat = GroupChat::where("group_id", $value->id)
                // ->where('from_id', auth()->user()->id)
                // ->orWhere(function ($query) use ($value) {
                //     $query->where('to_id', '=', auth()->user()->id);
                //     $query->where('from_id', '=', $value->id);
                // })
                ->orderBy('created_at', 'DESC')->first();
            $i++;
        }
        if ($data) {
            return APIFormatter::responseAPI(201, 'Request Success', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    // show
    public function show($id)
    {

        $data = GroupChat::where("group_id", $id)
            ->get();

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    //store
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                "group_id" => "required",
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $id = auth('sanctum')->user()->id;
            // $check = GroupMember::where('user_id', '=', $id)->where('approved_at', '!=', null)->orderBy('created_at', 'DESC')->first();

            // if (!$check) {
            //     return APIFormatter::responseAPI(403, 'Access to that resource is forbidden', null,);
            // }
            // $church = GroupChat::create([
            //     'message' => $request->message,
            //     'group_id' => $check->id,
            //     'from_id' => $id
            // ]);
            // $check = GroupMember::where('user_id', '=', $id)->where('approved_at', '!=', null)->orderBy('created_at', 'DESC')->first();
            $data = GroupChat::create([
                'message' => $request->message,
                'group_id' => $request->group_id,
                'from_id' => $id
            ]);

            if ($data) {
                # code...
                return APIFormatter::responseAPI(201, 'Success Created', $data);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
}
