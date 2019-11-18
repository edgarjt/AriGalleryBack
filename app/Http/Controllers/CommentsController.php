<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    function comments(Request $request){
        if($request->isJson()){
            $query = DB::table('comentarios')
                ->join('usuarios', 'comentarios.com_fk_usuario', '=', 'usuarios.id')
                ->select('comentarios.*', 'usuarios.usu_nombre', 'usuarios.usu_appaterno', 'usuarios.usu_apmaterno', 'usuarios.usu_telefono', 'usuarios.usu_email', 'usuarios.usu_clave')
                ->get();

            return response()->json($query, 200);

        }else{
            return json_encode(['response' => false], 401);
        }
    }
}
