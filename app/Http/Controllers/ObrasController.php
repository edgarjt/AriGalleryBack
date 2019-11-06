<?php

namespace App\Http\Controllers;

use App\Obras;
use function Composer\Autoload\includeFile;
use Dotenv\Validator;
use Faker\Provider\File;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Routing\Controller as BaseController;
use PHPQRCode\QRcode;


class ObrasController extends BaseController
{
    function allObras(Request $request){
        if ($request->isJson()){
            //$obras = Obras::all();
            $obras = DB::select('SELECT * FROM obras INNER JOIN autores ON obras.obr_clave_autor = autores.id');
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

        $nombre_img = $data['obr_clave'];
        //$descripcion = $data['obr_descripcion'];
        $ruta = $_SERVER['DOCUMENT_ROOT'] . '/galeriaBack/storage/app/obrasQR/' . $nombre_img . '.png';
        QRcode::png($nombre_img, $ruta, 'Q', '10', '1');
        $QR_Rute = 'http://arigaleriadearte.com/galeriaBack/storage/app/obrasQR/' . $nombre_img .'.png';

        $create = Obras::create([
            'obr_clave' => $data['obr_clave'],
            'obr_clave_autor' => 1,
            'obr_nombre' => $data['obr_nombre'],
            'obr_descripcion' => $data['obr_descripcion'],
            'obr_precio' => $data['obr_precio'],
            'obr_qr' => $QR_Rute,
            'obr_anio' => $data['obr_anio'],
            'obr_ancho' => $data['obr_ancho'],
            'obr_alto' => $data['obr_alto'],
            'obr_tecnica' => $data['obr_tecnica'],
            'obr_estado' => $data['obr_estado'],
            'obr_clave_remodelacion' => $data['obr_clave_remodelacion'],
            'obr_foto' => $save_url
        ]);

        return response()->json(['response' => true], 200);

    }


    function updateWorks(Request $request){

/*        if ($request->isJson()){
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
        }*/
return $request;
    }

    function deleteWorks(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $obra_delete = Obras::where('id', $data['id'])->first();

            if (empty($obra_delete)){
                return json_encode(['response' => false], 401);
            }
            $obra_delete->delete();
            //return json_encode(['response' => true], 200);
            return response()->json(['response' => true], 200);



        }
    }

    function whereWorks(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $user = Obras::where('obr_clave', $data['obr_clave'])->first();

            if(empty($user)){
                return json_encode(['response' => false], 401);
            }else{
                return response()->json($user, 200);
            }
        }else{
            return json_encode(['response' => 'No autorizado'], 401);
        }
    }

}
