<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\GroupChat;
use App\Models\GroupMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupChatController extends Controller
{
    //
    public function index()
    {
        $id = auth('sanctum')->user()->id;
        $check = GroupMember::where('user_id', '=', $id)
            ->orderBy('created_at', 'DESC')->first();

        $data = GroupChat::where("group_id", $check->id)
            ->where('from_id', $id)
            ->get();
        // dd($data2);

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    public function show2($id)
    {

        $check = GroupMember::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->first();

        $data = GroupChat::where("to_id", $id)
            ->where('from_id', auth()->user()->id)
            ->get();
        // dd($data2);

        return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
    }
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }

            $id = auth('sanctum')->user()->id;
            $check = GroupMember::where('user_id', '=', $id)->where('approved_at', '!=', null)->orderBy('created_at', 'DESC')->first();
            if (!$check) {
                return APIFormatter::responseAPI(403, 'Access to that resource is forbidden', null,);
            }
            $church = GroupChat::create([
                'message' => $request->message,
                'group_id' => $check->id,
                'from_id' => $id
            ]);

            $data = $church;
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
