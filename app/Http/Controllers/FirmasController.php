<?php

namespace App\Http\Controllers;

use App\Firmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class FirmasController extends BaseController
{
    function allFirmas(Request $request){
        if($request->isJson()){
            $data = Firmas::orderBy('fir_clave', 'desc')->get();
            return $data;
        }else{
            return response()->json(['response' => false], 401);
        }
    }

    function firmasAdd(Request $request){
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('firmas', $name);
        }

        $data = $request->all();

        $create = Firmas::create([
            'fir_clave' => $data['fir_clave'],
            'fir_nombre_autor' => $data['fir_nombre_autor'],
            'fir_lugar_nacimiento' => $data['fir_lugar_nacimiento'],
            'fir_foto' => $save_url,
        ]);

        return response()->json(['response' => true], 200);
    }

    function firmasUpdate(Request $request){
        if ($request->hasFile('fir_foto')){

            $archivo = $request->file('fir_foto');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('firmas', $name);

        }else{
            return json_encode(['response' => false], 401);
        }
        $id = $request['id'];

        DB::table('firmas')
            ->where('id', $id)
            ->update([
                'fir_nombre_autor' => $request['fir_nombre_autor'],
                'fir_lugar_nacimiento' => $request['fir_lugar_nacimiento'],
                'fir_foto' => $save_url

            ]);
        return response()->json(['response' => true], 200);


    }

    function firmasDelete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $id = $data['id'];

            $gallery_delete = Firmas::where('id', $id)->first();

            if (empty($gallery_delete)){
                return response()->json(['response' => false], 401);
            }else{
                $gallery_delete->delete();
                return response()->json(['response' => true], 200);
            }
        }
    }
}
