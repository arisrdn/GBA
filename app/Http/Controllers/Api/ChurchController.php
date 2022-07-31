<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\Church;
use Exception;
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
        $data=Church::all();
        if ($data) {
            return APIFormatter::responseAPI(200,'The request has succeeded',$data);
        } else {
            return APIFormatter::responseAPI(400,'failed');
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
        try {
            $validator = Validator::make($request->all(),[
                'name'=>'required',
             
            ]);

            if($validator->fails()) {

                return APIFormatter::responseAPI(422,'failed',null,$validator->errors() );
            }
            $church= Church::create([
                'name'=>$request->name,
            ]);

            $data=$church;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(201,'Success Created',$data);
            } else {
                # code...
                return APIFormatter::responseAPI(400,'failed');
            }

        } catch (Exception $err) {
            //throw $th;
            return APIFormatter::responseAPI(400,'failed');
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
           
            $data=Church::findOrFail($id)->branch;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200,'success',$data);
            } else {
                # code...
                return APIFormatter::responseAPI(400,'failed');
            }

        } catch (Exception $err) {
            //throw $th;
            // dd($err);
            return APIFormatter::responseAPI(400,'failed',null,$err->getMessage() );
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
        try {
           
            $validator = Validator::make($request->all(),[
                'name'=>'required',
             
            ]);

            if($validator->fails()) {

                return APIFormatter::responseAPI(422,'failed',null,$validator->errors() );
            }
            $church =Church::findOrFail($id);
            $church->update([
                'name'=>$request->name,
            ]);
 
            $data=$church;
            if ($data) {
                # code...
                return APIFormatter::responseAPI(200,'success update',$data);
            } else {
                # code...
                return APIFormatter::responseAPI(400,'failed');
            }

        } catch (Exception $err) {
            //throw $th;
            // dd($err);
            return APIFormatter::responseAPI(400,'failed',null,$err->getMessage() );
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
        try {
           
            $employe =Church::findOrFail($id);
            $data= $employe->delete();

            if ($data) {
                # code...
                return APIFormatter::responseAPI(200,'success delete',$data);
            } else {
                # code...
                return APIFormatter::responseAPI(400,'failed');
            }

        } catch (Exception $err) {
            //throw $th;
            // dd($err);
            return APIFormatter::responseAPI(400,'failed',null,$err->getMessage() );
        }
    }
}
