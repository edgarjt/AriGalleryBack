<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsuariosController extends BaseController
{
    function getUsers(Request $request){
       if ($request->isJson()){
            $obras = Usuarios::all();
            return response()->json($obras, 200);
        }else{
            return response()->json(['response' => false], 401);
        }


    }

    function addUsers(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();

            $create = Usuarios::create([
                'usu_clave' => $data['usu_clave'],
                'usu_telefono' => $data['usu_telefono'],
                'usu_email' => $data['usu_email'],
                'usu_pass' => Hash::make($data['usu_pass']),
                'usu_nombre' => $data['usu_nombre'],
                'usu_appaterno' =>  $data['usu_appaterno'],
                'usu_apmaterno' => $data['usu_apmaterno'],
                'usu_tipo' => $data['usu_tipo']
            ]);
            return response()->json($create, 200);
        }else{
            return json_encode(['response' => false], 401);
        }

    }
    function login(Request $request){
        if($request->isJson()){
            try{
                $data = $request->json()->all();
                $user = Usuarios::where('usu_telefono', $data['usu_telefono'])->first();

                if ($user && Hash::check($data['usu_pass'], $user->usu_pass)){
                    return response()->json($user, 200);
                }else{
                    return json_encode(['response' => false], 401);
                }

                //return $user;

            }catch (ModelNotFoundException $e){
                return json_encode(['response' => false], 401);
            }
        }else{
            return json_encode(['response' => false], 401);
        }
    }
    function update(Request $request){

        if ($request->isJson()) {
            $data = $request->json()->all();
            $user_update = Usuarios::where('id', $data['id'])->first();
            if (empty($user_update)) {
                return json_encode(['response' => false], 401);
            } else {
                $user_update->update($data);
                return response()->json(['response' => true], 200);
            }
        }else{
            return json_encode(['response' => false], 401);
        }
    }

    function delete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $user_delete = Usuarios::where('id', $data['id'])->first();
            if (empty($user_delete)){
                return json_encode(['response' => false], 401);
            }else{
                $user_delete->delete();
                return response()->json(['response' => true], 200);
            }
        }else{
            return json_encode(['response' => false], 401);
        }
    }
}
