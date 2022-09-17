<?php

namespace App\Http\Controllers;

use App\Helpers\Setting;
use App\Imports\GroupActivityImport;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\User;
use App\Models\WaitingList;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index()
    {
        //
        return view('admin.profile');
    }
    public function changepassword(Request $request)
    {
        // dd($request);
        // $id = auth('sanctum')->user()->id;
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $data = auth()->user();
        if (Hash::check($request->old_password, $data->password)) {
            $data->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return back()->with('success', 'Berhasil Di ubah');
        } else {
            return back()->with('error', 'password lama tidak sesuai');
        }
    }


    public function indexleave()
    {
        //
        // Excel::import(new GroupActivityImport(2), public_path('/files/upload.xlsx'));
        $data = GroupMember::where('approved_at', null)->get();
        $data2 = GroupMember::where('approved_at', "!=", null)
            ->where('reason_leave_id', '!=', null)
            ->where('leave_at', null)
            ->get();
        $member = WaitingList::where('type', "leave")->get();
        return view('admin.leave', compact("member"));
    }
    public function indexjoin()
    {

        $group = Group::where('end_date', ">", today())->withCount('user')->having('user_count', "<", Setting::MAXUSER)
            ->get();
        // dd($group);
        $member = WaitingList::where('type', "join")->get();
        // $user = User::find(24);
        // serach arrayobj
        // foreach ($group as $object) {
        //     if ($object->group_plan_id == 2) {
        //         $result = $object;
        //         break;
        //     }
        // }
        // unset($object);
        // dd($user->waitinglist);
        return view('admin.approve', compact("member", "group"));
    }
    public function indextf()
    {
        $group = Group::where('end_date', ">", today())->withCount('user')->having('user_count', "<", Setting::MAXUSER)
            ->get();
        $member = WaitingList::where('type', "transfer")->get();

        return view('admin.transfer', compact("member", "group"));
    }

    public function storejoin(Request $request)
    {
        // dd($request)
        try {
            //code...
            $wl = WaitingList::find($request->wl_id);

            $todo = GroupTodolist::where("group_id", $request->group_id)->get();
            $data = GroupMember::create([
                'user_id' => $wl->user_id,
                'group_id' => $request->group_id,
                'approved_at' => Carbon::now()
            ]);

            if ($data) {
                $wl->delete();
                return back()->with('success', 'Berhasil Di Approve');
            } else {
                return back()->with('error', 'Terjadi Kesalahan');
            }


            // foreach ($todo as  $val) {
            //     // dd($val);
            //     // MemberTodolist::create([
            //     //     'group_member_id' => $data->id,
            //     //     'group_todolist_id' => $val->id,
            //     //     'schedule' => Carbon::now()->addDays($val->day)
            //     // ]);
            // }
            // dd($todo);
            return back()->with('status', 'Berhasil');
        } catch (\Throwable $th) {
            throw $th;
            // dd($th);

            return back()->with('status', 'galat');
        }
    }
    public function storeleave(Request $request)
    {
        try {
            $wl = WaitingList::find($request->wl_id);
            $data = GroupMember::find($request->gm_id);
            $data->leave_at = Carbon::now();
            $data->reason_leave_id = $wl->reason_leave_id;
            $data->note = json_decode($wl->data)->note;
            $data->save();
            if ($data) {
                $wl->delete();
                return back()->with('success', 'Berhasil Di Approve');
            } else {
                return back()->with('error', 'Terjadi Kesalahan');
            }
        } catch (\Throwable $th) {

            return back()->with('status', 'galat');
        }
    }
    public function storetf(Request $request)
    {
        try {
            // dd($request);
            $wl = WaitingList::find($request->wl_id);
            $gl = GroupMember::find($request->gm_id);
            $gl->leave_at = Carbon::now();
            $gl->transfer = $wl->data;
            $gl->save();

            if ($wl->data) {
                $data = GroupMember::create([
                    'user_id' => $wl->user_id,
                    'group_id' => $request->group_id,
                    'approved_at' => Carbon::now()
                ]);
            }

            if ($gl) {
                $wl->delete();
                return back()->with('success', 'Berhasil Di Approve');
            } else {
                return back()->with('error', 'Terjadi Kesalahan');
            }
        } catch (\Throwable $th) {
            throw $th;
            return back()->with('status', 'galat');
        }
    }
}
