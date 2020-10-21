<?php

namespace App\Http\Controllers;

use App\Firmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('firmas', $name);
        }else {
            $save_url = $data['fir_foto'];
        }

        $clave = time() . Str::random(8);

        $create = Firmas::create([
            'fir_clave' => $clave,
            'fir_nombre_autor' => $data['fir_nombre_autor'],
            'fir_lugar_nacimiento' => $data['fir_lugar_nacimiento'],
            'fir_foto' => $save_url,
        ]);

        
        if ($create) {
            return $create;
        }
        return response()->json(['response' => false], 401);
    }

    function firmasUpdate(Request $request){
        $data = $request->all();
        if ($request->hasFile('fir_foto')){

            $archivo = $request->file('fir_foto');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('firmas', $name);

        }else{
            $save_url = $data['fir_foto'];
        }

        $id = $data['id'];

        $response = Firmas::where('id', $id)->first();
            $response->update([
                'fir_nombre_autor' => $request['fir_nombre_autor'],
                'fir_lugar_nacimiento' => $request['fir_lugar_nacimiento'],
                'fir_foto' => $save_url

            ]);
            if ($response) {
            return $response;
            }
            return response()->json(['response' => false]);


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
