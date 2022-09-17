<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Helpers\Setting;
use App\Http\Controllers\Controller;
use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use App\Models\WaitingList;
use Carbon\Carbon;
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
        $gm = GroupMember::where('user_id', '=', $id)->orderBy('id', 'DESC')->first();
        $gt = GroupTodolist::where("group_id", $gm->group_id)->get();
        $coun_gt = count($gt);
        // dd($gm->group->end_date);
        $data = MemberTodolist::where('group_member_id', $gm->id)->get();
        if ($data) {
            $count = count($data);
            // $count = 129;
            $res = $gt[$count];
            $res["lasread"] = false;
            $res["group_expire"] = false;
            if ($count == $coun_gt - 1) {
                $res["lasread"] = true;
            }
            if (today() >= $gm->group->end_date) {
                $res["lasread"] = true;
                $res["group_expire"] = true;
            }

            // dd($count);
            return APIFormatter::responseAPI(200, 'The request has succeeded', $res);
        } else {
            return APIFormatter::responseAPI(200, 'The request has succeeded', $gt[0]);
        }


        // return APIFormatter::responseAPI(200, 'The request has succeeded', $gt);

        // if ($data) {
        //     return APIFormatter::responseAPI(200, 'The request has succeeded', $data);
        // } else {
        //     return APIFormatter::responseAPI(400, 'failed');
        // }
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
            $todo_id = $request->todo_id;
            $id = auth('sanctum')->user()->id;
            $gm = GroupMember::where('user_id', '=', $id)->orderBy('id', 'DESC')->first();
            $read = now();
            $endtime = Carbon::parse(date("Y-m-d") . " " . Setting::ENDTIME);


            if ($read < $endtime) {
                # code...
                $read = Carbon::parse(date("Y-m-d") . " " . Setting::STARTTIME)->addDay(1);
            }
            $check = MemberTodolist::where("group_todolist_id", $todo_id)->where("group_member_id", $gm->id)->first();
            if ($check) {
                return APIFormatter::responseAPI(200, 'already submitted');
            }
            $todo = MemberTodolist::create([
                'group_todolist_id' => $todo_id,
                'group_member_id' =>  $gm->id,
                'read_at' => $read,
            ]);


            if ($request->transfer) {
                // dd()
                $data = WaitingList::create([
                    'user_id' => $id,
                    'type' => "transfer",
                    'data' => $request->transfer
                ]);
            }
            $mt = MemberTodolist::where('group_member_id', $gm->id)->get();
            $gt = GroupTodolist::where("group_id", $gm->group_id)->get();
            if (count($mt) == count($gt)) {
                # code...
                $gm->complete_at = now();
                $gm->save();
            }
            $data = $todo;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'post read success', $data);
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
