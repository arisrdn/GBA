<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use App\Models\User;
use App\Notifications\ApiEmailVerified;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Message;
use App\Notifications\User\GlobalNotification;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GroupMember::where('approved_at', null)->limit(3)->get();
        $data2 = GroupMember::where('approved_at', "!=", null)
            ->where('reason_leave_id', '!=', null)
            ->where('leave_at', null)->limit(3)
            ->get();
        // $datagroup = Group::withCount("totalMember")->orderBy('total_member_count', 'desc')
        //     ->take(5)->get();
        $datagroup = Group::withCount("member")->orderBy('member_count', 'desc')
            ->get();

        $usersData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // $dat = $datagroup->transform(function ($datagroup) {
        //     return [

        //         $datagroup->name
        //     ];
        // });

        // foreach ($datagroup as $key) {

        //     print_r($key->total_member_count);
        // }
        // return response()->json($datagroup, 200);

        // dd($datagroup);
        // foreach ($data as $key) {
        //     # code...
        //     // dd($key->member2());
        //     dd($key->group->name);
        // }
        return view('admin.dashboard', compact("datagroup", "usersData"))->with('member', $data,)->with('member2', $data2,);;
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
    public function approve(Request $request)
    {
        try {
            //code...
            $data = GroupMember::find($request->id);
            $data->approved_at = Carbon::now();
            $data->save();
            $todo = GroupTodolist::where("group_id", $data->group_id)->get();

            foreach ($todo as  $val) {
                MemberTodolist::create([
                    'group_member_id' => $data->id,
                    'group_todolist_id' => $val->id,
                    'schedule' => Carbon::now()->addDays($val->day)
                ]);
            }
            // dd($todo);
            return back()->with('status', 'Berhasil');
        } catch (\Throwable $th) {
            throw $th;
            // dd($th);

            return back()->with('status', 'galat');
        }
    }
    public function approveleave(Request $request)
    {
        try {
            //code...
            $data = GroupMember::find($request->id);
            $data->leave_at = Carbon::now();
            $data->save();
            // dd($data->group_id);


            // dd($todo);
            return back()->with('status', 'Berhasil');
        } catch (\Throwable $th) {
            throw $th;
            // dd($th);

            return back()->with('status', 'galat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cratemessage(Request $request)
    {
        //
        $chat = Chat::create([
            'from_id' => auth()->user()->id,
            'message' => $request->message
        ]);

        return redirect()->back();
    }

    public function update()
    {
        $data = User::all();
        $data2 = Chat::all();
        $data3 = Group::all();
        // dd($data2);
        // foreach ($data as $key) {
        //     # code...
        //     // dd($key->member2());
        //     dd($key->group->name);
        // }
        // return view('admin.test')->with('data1', $data,)->with('data2', $data2,)->with('data3', $data3)->with('notifications', auth()->user()->unreadNotifications);
        return view('admin.test')->with('data1', $data,)->with('data2', $data2,)->with('data3', $data3)->with('notifications', auth()->user()->unreadNotifications);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        //
        return View::make("layouts.partials.chat")
            ->with("status", "something")
            ->render();
    }


    public function abc()
    {
        $user = User::find(5);
        $data2 = Chat::all();
        $data3 = Group::all();
        // dd($data2);
        // foreach ($data as $key) {
        //     # code...
        //     // dd($key->member2());
        //     dd($key->group->name);
        // }
        $message = Message::REGISTER;
        $user->notify(new GlobalNotification($message));
        // auth()->user()->notify(new UserNotification($user, $message));
        // $user->notifications
        // dd(auth()->user()->unreadNotifications);

        return auth()->user()->unreadNotifications;
    }
}
