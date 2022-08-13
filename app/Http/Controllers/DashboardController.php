<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
