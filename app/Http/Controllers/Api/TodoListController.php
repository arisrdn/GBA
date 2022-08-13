<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use App\Models\MemberTodolist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class TodoListController extends Controller
{
    //
    public function index()
    {
        $id = auth('sanctum')->user()->id;

        $check = GroupMember::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->first();
        $data = MemberTodolist::with('todolist')->where('group_member_id', $check->id)->get();
        // dd($data);

        if ($data) {
            return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }
    }


    public function summary()
    {
        $id = auth('sanctum')->user()->id;

        $check = GroupMember::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->first();
        $todo = MemberTodolist::where('group_member_id', $check->id)->get();
        $unread = MemberTodolist::where('group_member_id', $check->id)->where('read_at', null)->get();
        // dd(count($todo));
        $readed = count($todo) - count($unread);
        $percentage = round($readed / count($todo) * 100);
        // dd($percentage);

        $data = array("todolist" => count($todo), "readed" => $readed, "unread" => count($unread), "percentage" => $percentage);
        if ($data) {
            return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }
    }
    public function today()
    {
        $id = auth('sanctum')->user()->id;

        $check = GroupMember::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->first();
        $data = MemberTodolist::with('todolist')->where('group_member_id', $check->id)->where('schedule', now())->get();
        // dd($data);

        if ($data) {
            return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }
    }
    public function history()
    {
        $id = auth('sanctum')->user()->id;

        $check = GroupMember::where('user_id', '=', $id)->orderBy('created_at', 'DESC')->first();
        $data = MemberTodolist::with('todolist')->where('group_member_id', $check->id)->where('read_at', '!=', null)->get();
        // dd($data);

        if ($data) {
            return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        } else {
            return APIFormatter::responseAPI(400, 'failed');
        }
    }
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'todo_id' => 'required',

            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $id = $request->todo_id;
            $church = MemberTodolist::findOrFail($id);
            $church->update([
                'read_at' => now()
            ]);
            $data = $church;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'success update', $data);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            //throw $th;
            // dd($err);
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
    }
}
