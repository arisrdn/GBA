<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    //
    public function index()
    {
        # code...
        return APIFormatter::responseAPI(200, 'success update',);
    }
}
