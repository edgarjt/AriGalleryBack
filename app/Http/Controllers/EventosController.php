<?php

namespace App\Http\Controllers;

use App\Eventos;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EventosController extends BaseController
{
    function ultimateEvents(Request $request){

        if ($request->isJson()) {
            $response = Eventos::orderBy('id', 'desc')->where('eve_tipo', 0)->get();
            return $response;
        }

    }

        function ultimatePlaticas(Request $request){

        if ($request->isJson()) {
            $response = Eventos::orderBy('id', 'desc')->where('eve_tipo', 1)->get();
            return $response;
        }

    }

        function ultimateTalleres(Request $request){

        if ($request->isJson()) {
            $response = Eventos::orderBy('id', 'desc')->where('eve_tipo', 2)->get();
            return $response;
        }

    }

        function ultimateExpociciones(Request $request){

        if ($request->isJson()) {
            $response = Eventos::orderBy('id', 'desc')->where('eve_tipo', 3)->get();
            return $response;
        }

    }

        function allEvents(Request $request){

        if ($request->isJson()) {
            $response = Eventos::all();
            return $response;
        }

    }

    function addEvents(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $reponse = Eventos::create([
                'eve_nombre' => $data['eve_nombre'],
                'eve_tipo' => $data['eve_tipo'],
                'eve_descripcion' => $data['eve_descripcion'],
                'eve_fecha' => $data['eve_fecha'],
                'eve_horario' => $data['eve_horario'],
            ]);
            return $reponse;
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
                return $update_event;
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
