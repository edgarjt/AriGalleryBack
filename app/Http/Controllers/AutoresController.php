<?php

namespace App\Http\Controllers;
use App\Autores;
use http\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Laravel\Lumen\Routing\Controller as BaseController;

class AutoresController extends BaseController
{
    function allAutores(Request $request){
        if ($request->isJson()){
              $autores = Autores::all();
/*            $autores = DB::table('autores')
                ->join('obras', 'autores.id', '=', 'obras.obr_clave_autor')
                ->select('autores.*', 'obras.obr_foto')
                ->get();*/
            return response()->json($autores, 200);
        }else{
            return json_encode(['response' => false], 401);
        }

    }

    function allAutoresAdd(Request $request){
        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('autoresAvatar', $name);

        }else {
            $save_url = $data['aut_foto'];
        }
        

        Autores::create([
            'aut_clave' => $data['aut_clave'],
            'aut_nombre' => $data['aut_nombre'],
            'aut_apellidos' => $data['aut_apellidos'],
            'aut_foto' => $save_url,
            'aut_templanza' => $data['aut_templanza'],
        ]);
        return response()->json(['response' => true], 200);

    }

    function AutoresUpdate(Request $request){
        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('autoresAvatar', $name);

        }else {
            $save_url = $data['aut_foto'];
        }

            $artis = Autores::where('id', $data['id'])->first();

            if (empty($artis)){
                return json_encode(['response' => false], 401);
            }else{
                $artis->update([
            'aut_clave' => $data['aut_clave'],
            'aut_nombre' => $data['aut_nombre'],
            'aut_apellidos' => $data['aut_apellidos'],
            'aut_foto' => $save_url,
            'aut_templanza' => $data['aut_templanza'],
        ]);

                return response()->json(['response' => true], 200);
            }

    }
    function AutoresDelete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();

            $id = $data['id'];

            $query = DB::table('autores')->where('id', '=', $id)->delete();

            if ($query == 1) {
                return response()->json(['response' => true], 200);
            }

            return response()->json(['response' => false], 401);

        }else{
            return json_encode(['response' => false], 401);
        }
    }

}
