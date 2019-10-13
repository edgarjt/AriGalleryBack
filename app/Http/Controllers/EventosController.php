<?php

namespace App\Http\Controllers;

use App\Eventos;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EventosController extends BaseController
{
    function ultimateEvents(Request $request){
        if ($request->isJson()){
            $data = Eventos::orderBy('id', 'desc')->get();
            return response()->json($data, 200);
        }else{
            return response()->json(['response' => false], 401);
        }

    }
}
