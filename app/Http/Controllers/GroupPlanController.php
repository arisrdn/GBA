<?php

namespace App\Http\Controllers;

use App\Models\GroupPlan;
use Illuminate\Http\Request;

class GroupPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = GroupPlan::all();
        return view("admin.plan", compact("data"));
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required',

        ]);
        $church = GroupPlan::create([
            'description' => $request->description,
        ]);

        $data = $church;
        if ($data) {
            return back()->with('success', 'Data Berhasil Di Tambah');
        } else {
            return back()->with('error', 'Data Gagal Di Tambah');
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
    public function update(Request $request)
    {
        //
        $request->validate([
            'description' => 'required',

        ]);
        $church = GroupPlan::findOrFail($request->id);
        $church->update([
            'description' => $request->description,
        ]);
        $data = $church;
        if ($data) {
            return back()->with('success', 'Data Berhasil Di Ubah');
        } else {
            return back()->with('error', 'Data Gagal Di Tambah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
