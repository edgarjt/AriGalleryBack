<?php

namespace App\Http\Controllers;

use App\Obras;
use Dotenv\Validator;
use Faker\Provider\File;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;
//use Illuminate\Support\Facades\Storage;

class ObrasController extends BaseController
{
    function allObras(Request $request){
        if ($request->isJson()){
            $obras = Obras::all();
            return response()->json($obras, 200);
        }else{
            return response()->json(['response' => false], 401);
        }


    }

    function addWorks(Request $request){

        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('avatars', $name);

        }

        $data = $request->all();

        $create = Obras::create([
            'obr_clave' => $data['obr_clave'],
            'obr_clave_autor' => 1,
            'obr_nombre' => $data['obr_nombre'],
            'obr_descripcion' => $data['obr_descripcion'],
            'obr_precio' => $data['obr_precio'],
            'obr_qr' => $data['obr_qr'],
            'obr_anio' => $data['obr_anio'],
            'obr_ancho' => $data['obr_ancho'],
            'obr_alto' => $data['obr_alto'],
            'obr_tecnica' => $data['obr_tecnica'],
            'obr_estado' => $data['obr_estado'],
            'obr_clave_remodelacion' => $data['obr_clave_remodelacion'],
            'obr_foto' => $save_url
        ]);

        return response()->json($create, 200);

    }


    function updateWorks(Request $request){

        if ($request->isJson()){
            try{
                $data = $request->json()->all();
                $obraUpdate = Obras::where('id', $data['id'])->first();
                $obraUpdate->update($data);

                return response()->json(['response' => true], 200);
            }catch (ModelNotFoundException $e){
                return response()->json(['response' => false, 401]);
            }

        }else{
            return response()->json(['response' => false], 401);
        }
    }

    function deleteWorks(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $obra_delete = Obras::where('id', $data['id'])->first();

            if (empty($obra_delete)){
                return response()->json(['response' => false], 404);
            }
            $obra_delete->delete();
            return response()->json(['response' => true], 404);



        }
    }

}
