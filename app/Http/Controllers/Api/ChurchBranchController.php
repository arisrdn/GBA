<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\ChurchBranch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {

            $data = ChurchBranch::where('church_id', $id)->get()->church;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'success', $data);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            throw $err;
            // dd($err);
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
        }
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
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'church_id' => 'required',
            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $church = ChurchBranch::create([
                'name' => $request->name,
                'adress' => $request->adress,
                'church_id' => $request->church_id
            ]);

            $data = $church;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(201, 'Success Created', $data);
            } else {
                # code...
                return APIFormatter::responseAPI(400, 'failed');
            }
        } catch (Exception $err) {
            // throw $err;
            return APIFormatter::responseAPI(400, 'failed', null, $err->getMessage());
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
        try {

            $data = ChurchBranch::findOrFail($id);
            $data->church = $data->church()->get();
            // dd($data);
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'success', $data);
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
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'church_id' => 'required',
            ]);

            if ($validator->fails()) {

                return APIFormatter::responseAPI(422, 'failed', null, $validator->errors());
            }
            $church = ChurchBranch::findOrFail($id);
            $church->update([
                'name' => $request->name,
                'adress' => $request->adress,
                'church_id' => $request->church_id
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {

            $employe = ChurchBranch::findOrFail($id);
            $data = $employe->delete();

            if ($data) {
                # code...
                return APIFormatter::responseAPI(200, 'success delete', $data);
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
