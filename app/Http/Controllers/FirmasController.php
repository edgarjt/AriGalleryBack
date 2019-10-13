<?php

namespace App\Http\Controllers;

use App\Firmas;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class FirmasController extends BaseController
{
    function allFirmas(Request $request){
        if($request->isJson()){
            $data = Firmas::orderBy('fir_clave', 'desc')->get();
            return $data;
        }else{
            return response()->json(['response' => false], 401);
        }
    }
}
