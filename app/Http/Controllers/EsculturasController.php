<?php

namespace App\Http\Controllers;

use App\Esculturas;
use App\Usuarios;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use PHPQRCode\QRcode;
use http\Env\Response;

class EsculturasController extends BaseController
{
    function allEsculturas(Request $request){
        if ($request->isJson()){
            $obras = DB::table('esculturas')
                ->join('autores', 'esculturas.esc_clave_autor', '=', 'autores.id')
                ->select('esculturas.*', 'autores.aut_nombre', 'autores.aut_apellidos')
                ->get();
            return response()->json($obras, 200);
        }else{
            return json_encode(['response' => false], 500);
        }
    }

    function AutorEsculturas(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $id = $data['id'];

            $obras_autor = DB::table('autores')
                ->join('esculturas', 'autores.id', '=', 'esculturas.esc_clave_autor')
                ->select('autores.aut_nombre','autores.aut_apellidos', 'esculturas.*')
                ->where('autores.id', '=', $id)
                ->get();

            return response()->json($obras_autor, 200);

        }else{
            return json_encode(['response' => false], 500);
        }

    }

    function addEsculturas(Request $request){
        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('esculturas', $name);

        }else{
            $save_url = $data['esc_foto'];
        }

        
        //$descripcion = $data['obr_descripcion'];
/*        $ruta = $_SERVER['DOCUMENT_ROOT'] . '/galeriaBack/storage/app/esculturasQR/' . $nombre_img . '.png';
        QRcode::png($nombre_img, $ruta, 'Q', '10', '1');
        $QR_Rute = 'http://arigaleriadearte.com/galeriaBack/storage/app/esculturasQR/' . $nombre_img .'.png';*/

        $QR_Rute = 'https://cdn.imgbin.com/24/12/23/imgbin-qr-code-barcode-scanners-scanner-scan-MmWAmjFyg69G9efg3dESL2TZF.jpg';
        $clave = time() . Str::random(8);


        $response = Esculturas::create([
            'esc_clave' => $clave,
            'esc_clave_autor' => $data['esc_clave_autor'],
            'telefono' => $data['telefono'],
            'esc_nombre' => $data['esc_nombre'],
            'esc_descripcion' => $data['esc_descripcion'],
            'esc_precio' => $data['esc_precio'],
            'esc_qr' => $QR_Rute,
            'esc_anio' => $data['esc_anio'],
            'esc_ancho' => $data['esc_ancho'],
            'esc_alto' => $data['esc_alto'],
            'esc_material' => $data['esc_material'],
            'esc_estado' => $data['esc_estado'],
            'esc_clave_remodelacion' => $data['esc_clave_remodelacion'],
            'esc_foto' => $save_url
        ]);

        return $response;


    }

    function updateEsculturas(Request $request){

        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('esculturas', $name);

        }else{
            $save_url = $data['esc_foto'];
        }

        $id = $data['id'];

        $QR_Rute = 'https://cdn.imgbin.com/24/12/23/imgbin-qr-code-barcode-scanners-scanner-scan-MmWAmjFyg69G9efg3dESL2TZF.jpg';

            $response = Esculturas::where('id', $id)->first();

                $response->update([
                    'esc_nombre' => $data['esc_nombre'],
                    'esc_clave_autor' => $data['esc_clave_autor'],
                    'esc_descripcion' => $data['esc_descripcion'],
                    'telefono' => $data['telefono'],
                    'esc_precio' => $data['esc_precio'],
                    'esc_qr' => $QR_Rute,
                    'esc_anio' => $data['esc_anio'],
                    'esc_ancho' => $data['esc_ancho'],
                    'esc_alto' => $data['esc_alto'],
                    'esc_material' => $data['esc_material'],
                    'esc_estado' => $data['esc_estado'],
                    'esc_foto' => $save_url
                ]);

                return $response;




    }

    function keyEsculturas(Request $request){
        if ($request->isJson()){
            try{
                $data = $request->json()->all();
/*                $getEsculturas = Esculturas::where('esc_clave', $data['esc_clave'])->first();

                if ($getEsculturas){
                    return response()->json($getEsculturas, 200);
                }else{
                    return response()->json(['response' => false], 401);
                }*/
                $clave_autor = $data['esc_clave'];

                $esculturas_autor = DB::table('esculturas')
                    ->join('autores', 'esculturas.esc_clave_autor', '=', 'autores.id')
                    ->select('autores.aut_nombre','autores.aut_apellidos', 'esculturas.*')
                    ->where('esculturas.esc_clave', '=', $clave_autor)
                    ->get();

                return response()->json($esculturas_autor, 200);

            }catch (ModelNotFoundException $e){
                return response()->json(['response' => false], 401);
            }

        }else{
            return response()->json(['response' => false], 4001);
        }
    }

    function deleteEsculturas(Request $request){
        if($request->isJson()){
            $request->json()->all();
            $id = $request['id'];
            $peticion = DB::table('esculturas')->where('id', $id)->delete();
            //return response()->json(['response' => true],200);

            if ($peticion == 0){
                return response()->json(['response' => false], 401);
            }else{
                return response()->json(['response' => true], 200);
            }
        }else{
            return response()->json(['response' => false], 401);
        }
    }

}
