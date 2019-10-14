<?php

namespace App\Http\Controllers;
use App\Autores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Laravel\Lumen\Routing\Controller as BaseController;

class AutoresController extends BaseController
{
    function allAutores(Request $request){
        if ($request->isJson()){
            $data = Autores::all();
            return response()->json($data, 200);
        }else{
            return response()->json(['response' => false], 401);
        }

    }

}
