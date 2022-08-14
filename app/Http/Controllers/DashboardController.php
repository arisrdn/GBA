<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GroupMember::where('approved_at', null)->get();
        $data2 = GroupMember::where('approved_at', "!=", null)
            ->where('reason_leave', '!=', null)
            ->where('leave_at', null)
            ->get();

        // dd($data2);
        // foreach ($data as $key) {
        //     # code...
        //     // dd($key->member2());
        //     dd($key->group->name);
        // }
        return view('admin.dashboard')->with('member', $data,)->with('member2', $data2,);;
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
            // dd($data->group_id);

            foreach ($todo as  $val) {
                // dd($val);
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
        return view('admin.test')->with('data1', $data,)->with('data2', $data2,)->with('data3', $data3);;
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
}
