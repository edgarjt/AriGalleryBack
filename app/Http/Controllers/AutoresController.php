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
            return json_encode(['response' => false], 401);
        }

    }

    function allAutoresAdd(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            Autores::create([
                    'aut_clave' => $data['aut_clave'],
                    "aut_nombre" => $data['aut_nombre'],
                     "aut_apellidos" => $data['aut_apellidos']
            ]);
            return response()->json(['response' => true], 200);
        }else{
            return json_encode(['response' => false]);
        }
    }

    function AutoresUpdate(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $artis = Autores::where('id', $data['id'])->first();
            if (empty($artis)){
                return json_encode(['response' => false], 401);
            }else{
                $artis->update($data);
                return response()->json(['response' => true], 200);
            }

        }else{
            return json_encode(['response' => false], 401);
        }
    }
    function AutoresDelete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $artis_delete = Autores::where('id', $data['id'])->first();

            if (empty($artis_delete)){
                return response()->json(['response' => false], 401);
            }else{
                $artis_delete->delete();
                return response()->json(['response' => true], 200);
            }
        }else{
            return json_encode(['response' => false], 401);
        }
    }

}
