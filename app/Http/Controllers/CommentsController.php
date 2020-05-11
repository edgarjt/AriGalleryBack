<?php

namespace App\Http\Controllers;
//use app\Comments;
use App\Comments;
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

    function commentsAdd(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();

            $clave = $data['com_clave'];
            $comentario = $data['com_comentario'];
            $fk_user = $data['com_fk_usuario'];

            $query = Comments::create([
                'com_clave' => $clave,
                'com_comentario' => $comentario,
                'com_fk_usuario' => $fk_user
            ]);
            return response()->json(['response' => true], 200);

        }else{
            return response()->json(['response' => false], 401);
        }
    }

    function commentsDelete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();

            $comm_delete = Comments::where('id', $data['id'])->first();

            if (empty($comm_delete)){
                return json_encode(['response' => false], 401);
            }
            $comm_delete->delete();
            //return json_encode(['response' => true], 200);
            return response()->json(['response' => true], 200);
        }else{
            return response()->json(['response' => false], 400);
        }
    }
}
