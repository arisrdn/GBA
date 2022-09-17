<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\ChurchBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gereja = ChurchBranch::all();
        $pusat = Church::all();
        return view("admin.church-branch", compact("gereja", "pusat"));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'church_id' => 'required',
            'address' => 'required',

        ]);


        $church = ChurchBranch::create([
            'name' => $request->name,
            'church_id' => $request->church_id,
            'address' => $request->address,

        ]);

        $data = $church;
        if ($data) {
            return back()->with('success', 'Data Berhasil Di Tambah');
        } else {
            return back()->with('error', 'Data Gagal Di Tambah');
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'church_id' => 'required',
            'address' => 'required',

        ]);


        $church = ChurchBranch::findOrFail($request->id);
        $church->update([
            'name' => $request->name,
            'church_id' => $request->church_id,
            'address' => $request->address,

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
