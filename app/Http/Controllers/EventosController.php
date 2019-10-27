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

    function addEvents(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            Eventos::create([
                'eve_nombre' => $data['eve_nombre'],
                'eve_descripcion' => $data['eve_descripcion'],
                'eve_fecha' => $data['eve_fecha'],
                'eve_horario' => $data['eve_horario'],
            ]);
            return response()->json(['response' => true], 200);
        }else{
            return json_encode(['response' => false], 401);
        }
    }

    function updateEvents(Request $request){
        if ($request->isJson()){
            $data =$request->json()->all();
            $update_event = Eventos::where('id', $data['id'])->first();

            if (empty($update_event)){
                return json_encode(['response' => false], 401);
            }else{
                $update_event->update($data);
                return response()->json(['response' => true], 200);
            }
        }
    }

    function deleteEvents(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $delete_event = Eventos::where('id', $data['id'])->first();

            if (empty($delete_event)){
                return json_encode(['response' => false], 401);
            }else{
                $delete_event->delete();
                return response()->json(['response' => true], 200);
            }
        }
    }
}
