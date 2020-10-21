<?php

namespace App\Http\Controllers;

use App\Obras;
use Dotenv\Validator;
use Faker\Provider\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use Mpdf\Mpdf;
use PHPQRCode\QRcode;
use function Composer\Autoload\includeFile;
use http\Env\Response;


class ObrasController extends BaseController
{
    function allObras(Request $request){
                if ($request->isJson()){
            $obras = DB::table('obras')
                ->join('autores', 'obras.obr_clave_autor', '=', 'autores.id')
                ->select('obras.*', 'autores.aut_nombre', 'autores.aut_apellidos')
                ->get();
            return response()->json($obras, 200);
                }else{
            return json_encode(['response' => false], 401);
        }



    }

/*    function LimitObras(Request $request){
        if ($request->isJson()){
            $obras = DB::table('obras')
                ->join('autores', 'obras.obr_clave_autor', '=', 'autores.id')
                ->select('obras.*', 'autores.aut_nombre', 'autores.aut_apellidos')
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();
            return response()->json($obras, 200);
        }else{
            return json_encode(['response' => false], 500);
        }
    }*/

    function AutorObras(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $id = $data['id'];

            $obras_autor = DB::table('autores')
                ->join('obras', 'autores.id', '=', 'obras.obr_clave_autor')
                ->select('autores.aut_nombre','autores.aut_apellidos', 'obras.*')
                ->where('autores.id', '=', $id)
                ->get();

                return response()->json($obras_autor, 200);

        }else{
            return json_encode(['response' => false], 500);
        }

        //return response()->json($id, 200);
    }

    function addWorks(Request $request){
        $data = $request->all();

        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('avatars', $name);

        }else {
            $save_url = $data['obr_foto'];
        }

        //$descripcion = $data['obr_descripcion'];
/*        $ruta = $_SERVER['DOCUMENT_ROOT'] . '/galeriaBack/storage/app/obrasQR/' . $nombre_img . '.png';
        QRcode::png($nombre_img, $ruta, 'Q', '10', '1');
        $QR_Rute = 'http://arigaleriadearte.com/galeriaBack/storage/app/obrasQR/' . $nombre_img .'.png';
        $QR_Rute = 'hola.com';*/

        $QR_Rute = 'https://cdn.imgbin.com/24/12/23/imgbin-qr-code-barcode-scanners-scanner-scan-MmWAmjFyg69G9efg3dESL2TZF.jpg';
        $clave = time() . Str::random(8);

        $create = Obras::create([
            'obr_clave' => $clave,
            'obr_clave_autor' => $data['obr_clave_autor'],
            'telefono' => $data['telefono'],
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

        return $create;

    }


    function updateWorks(Request $request){
    	$data = $request->all();

        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('avatars', $name);

        }else{
            $save_url = $data['obr_foto'];
        }

        

        $id = $data['id'];

        //$descripcion = $data['obr_descripcion'];
/*        $ruta = $_SERVER['DOCUMENT_ROOT'] . '/galeriaBack/storage/app/obrasQR/' . $nombre_img . '.png';
        QRcode::png($nombre_img, $ruta, 'Q', '10', '1');
        $QR_Rute = 'http://arigaleriadearte.com/galeriaBack/storage/app/obrasQR/' . $nombre_img .'.png';*/
        $QR_Rute = 'https://cdn.imgbin.com/24/12/23/imgbin-qr-code-barcode-scanners-scanner-scan-MmWAmjFyg69G9efg3dESL2TZF.jpg';

        $response = Obras::where('id', $id)->first();

            $response->update([
                'obr_clave_autor' => $data['obr_clave_autor'],
                'telefono' => $data['telefono'],
                'obr_nombre' => $data['obr_nombre'],
                'obr_descripcion' => $data['obr_descripcion'],
                'obr_precio' => $data['obr_precio'],
                'obr_qr' => $QR_Rute,
                'obr_anio' => $data['obr_anio'],
                'obr_ancho' => $data['obr_ancho'],
                'obr_alto' => $data['obr_alto'],
                'obr_tecnica' => $data['obr_tecnica'],
                'obr_estado' => $data['obr_estado'],
                //'esc_clave_remodelacion' => $data['esc_clave_remodelacion'],
                'obr_foto' => $save_url
            ]);

            return $response;

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
/*            $user = Obras::where('obr_clave', $data['obr_clave'])->first();

            if(empty($user)){
                return json_encode(['response' => false], 401);
            }else{
                return response()->json($user, 200);
            }*/
            $clave_autor = $data['obr_clave'];

            $obras_autor = DB::table('obras')
                ->join('autores', 'obras.obr_clave_autor', '=', 'autores.id')
                ->select('autores.aut_nombre','autores.aut_apellidos', 'obras.*')
                ->where('obras.obr_clave', '=', $clave_autor)
                ->get();

            return response()->json($obras_autor, 200);


        }else{
            return json_encode(['response' => 'No autorizado'], 401);
        }
    }

    function obrasReport(){
        return view('pdf.index');

    }

}
