<?php

namespace App\Http\Controllers;

use App\Resset;
use App\Usuarios;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsuariosController extends BaseController
{
    function getUsers(Request $request){
       if ($request->isJson()){
            $obras = Usuarios::all();
            return response()->json($obras, 200);
        }else{
            return json_encode(['response' => false], 402);
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
            $data = $request->json()->all();
            $user = Usuarios::where('usu_email', $data['usu_email'])->first();

            if ($user == null) {
            	return response()->json(['response' => 'email']);
            	
            }else if (Hash::check($data['usu_pass'], $user->usu_pass)){
                return response()->json(['response' => $user], 200);

            }else{
                return json_encode(['response' => 'password'], 401);

            }
        }
            return json_encode(['response' => 'No autorizado'], 401);

    }
    function update(Request $request){

        if ($request->isJson()) {
            $data = $request->json()->all();
            $user_update = Usuarios::where('id', $data['id'])->first();
            if (empty($user_update)) {
                return json_encode(['response' => false], 401);
            } else {
                $user_update->update([
			        'usu_clave' => $data['usu_clave'],
                    'usu_telefono' => $data['usu_telefono'],
                    'usu_email' => $data['usu_email'],
                    'usu_pass' => Hash::make($data['usu_pass']),
                    'usu_nombre' => $data['usu_nombre'],
                    'usu_appaterno' => $data['usu_appaterno'],
                    'usu_apmaterno' => $data['usu_apmaterno'],
                    'usu_tipo' => $data['usu_tipo']
                ]);
                /*return response()->json(['response' => true], 200);*/
                return $user_update;
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

    function userwhere(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $user = Usuarios::where('id', $data['id'])->first();

            if(empty($user)){
                return json_encode(['response' => false], 401);
            }else{
                return response()->json($user, 200);
            }
        }else{
            return json_encode(['response' => 'No autorizado'], 401);
        }
    }

    function ressetPass(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $email = $data['usu_email'];
            $user = Usuarios::where('usu_email', $email)->first();
            //$user = DB::table('usuarios')->where('usu_email', $email)->first();

            if (empty($user)){
                return response()->json(['mensaje' => 'El correo no se encuentra registrado'], 401);
            }else{
                $code = Str::random(10);
                $create = Resset::create([
                    'email' => $email,
                    'code' => $code,
                ]);
            //Enviar email al usuario
                $to = $email;
                $subject = "Soporte arigaleriadearte.com";
                $message = "Code: " . $code;

                mail($to, $subject, $message);
                return response()->json(['response' => true], 200);

            }
        }else{
            return response()->json(['response' => false], 401);
        }
    }
}
