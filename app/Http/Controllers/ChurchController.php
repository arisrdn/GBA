<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gereja = Church::all();
        return view("admin.church", compact("gereja"));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);


        $church = Church::create([
            'name' => $request->name,
        ]);

        $data = $church;
        if ($data) {
            return back()->with('success', 'Data Berhasil Di Tambah');
        } else {
            return back()->with('error', 'Data Gagal Di Tambah');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);


        $church = Church::findOrFail($request->id);
        $church->update([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Data Berhasil Di Ubah');
    }

    public function show($id)
    {

        $gereja = Church::find($id);
        return view("admin.church-branch", compact("gereja"));
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
