<?php

namespace App\Http\Controllers;

use App\Helpers\APIFormatter;
use App\Imports\GroupTodolistImport;
use App\Models\Group;
use App\Models\GroupAdmin;
use App\Models\GroupEod;
use App\Models\GroupPlan;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Group::withCount('user')->get();
        return view("admin.group", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $plan = GroupPlan::all();
        $user = User::where("role_id", "3")->get();
        return view("admin.group-add", compact("plan", "user"));
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
        // dd($request->all());
        try {

            $request->validate([
                'name' => 'required',
                'plan_id' => 'required',
                'pic' => 'required',
                'copic' => 'required',
                'todo' => 'required',

            ]);
            if ($file = $request->file('todo')) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $name = 'gba-' . time() . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
                $path = $file->move(public_path('files/'), $name);
            }
            // dd($request);
            $group = Group::create([
                'name' => $request->name,
                'group_plan_id' => $request->plan_id,
                'todo_file' => $name
            ]);
            // dd($group->id);
            $datagp = Group::find($group->id);
            if ($group) {
                $plan = GroupEod::create([
                    'group_id' => $datagp->id,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                $Groupchat = GroupAdmin::create([
                    'group_id' => $datagp->id,
                    'user_id' =>  $request->pic,
                    'type' => "0"

                ]);
                $Groupchat = GroupAdmin::create([
                    'group_id' => $datagp->id,
                    'user_id' =>  $request->copic,
                    'type' => "1"

                ]);
                Excel::import(new GroupTodolistImport($datagp->id), public_path('files/' . $name));
            } else {
                # code...
            }


            $data = $plan;
            if ($data) {
                # code...
                return redirect(route("group"))->with('success', 'Data Berhasil Di Tambah');
            } else {
                # code...
                return back()->with('error', 'Data Gagal Di Tambah');
            }
        } catch (Exception $err) {
            $file_path = public_path('files/') . $name;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
            return back();
            // throw $err;
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
        $data = Group::find($id);
        $plan = GroupPlan::all();
        $admin = User::where("role_id", 1)->get();

        return view("admin.group-detail", compact("data", "plan", "admin"));
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
    public function updatetodo(Request $request)
    {
        //


        try {

            $request->validate([
                'name' => 'required',
                'plan_id' => 'required',
                'start' => 'required',
                'end' => 'required',

            ]);
            // dd($request);
            if ($file = $request->file('todo')) {

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $name = 'gba-' . time() . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $file->extension();
                $path = $file->move(public_path('files/'), $name);

                $group = Group::findOrFail($request->group_id);
                $group->update([
                    'name' => $request->name,
                    'group_plan_id' => $request->plan_id,
                    'todo_file' => $name
                ]);
                $del = GroupTodolist::where('group_id', $request->group_id)->delete();
                if ($del) {
                    # code...
                    Excel::import(new GroupTodolistImport($request->group_id), public_path('files/' . $name));
                }
            } else {
                $group = Group::findOrFail($request->group_id);
                $group->update([
                    'name' => $request->name,
                    'group_plan_id' => $request->plan_id,
                ]);
            }


            if ($group) {
                $plan = GroupEod::where("group_id", $group->id)->first();
                $plan->update([
                    'group_id' => $request->group_id,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
            }


            $data = $plan;
            if ($data) {
                # code...
                return back()->with('success', 'Data Berhasil Ubah');
            } else {
                # code...
                return back()->with('error', 'Data Gagal di Ubah');
            }
        } catch (Exception $err) {
            $file_path = public_path('files/') . $name;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
            return back()->with('error', "terjadi kesalahan");
            throw $err;
        }
    }


    public function updateadmin(Request $request)
    {

        // dd($request);
        $request->validate([
            'group_id' => 'required',
            'admin_id' => 'required',
        ]);
        $data = GroupAdmin::create(
            [
                'group_id' => $request->group_id,
                'user_id' => $request->admin_id,
            ]
        );
        if ($data) {
            # code...
            return back()->with('success', 'Data Berhasil Ubah');
        } else {
            # code...
            return back()->with('error', 'Data Gagal di Ubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
