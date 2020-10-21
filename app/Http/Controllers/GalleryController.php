<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function GaleriavAll(Request $request){
        if ($request->isJson()){
            $galeria = Gallery::all()->all();
            return response()->json($galeria, 200);

        }else{
            return response()->json(['response' => false], 401);
        }
    }

    function GalleryAdd(Request $request){
        $data = $request->all();
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('galleryV', $name);

        }else {
            $save_url = $data['gal_foto'];
        }

        $create = Gallery::create([
            'gal_titulo' => $data['gal_titulo'],
            'gal_foto' => $save_url,
            'gal_descripcion' => $data['gal_descripcion'],
        ]);

        return $create;
    }

    function GalleryUpdate(Request $request){
        $data = $request->all();
        if ($request->hasFile('gal_foto')){

            $archivo = $request->file('gal_foto');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('galleryV', $name);

        }else{
            $save_url = $data['gal_foto'];
        }

        $id = $data['id'];

        $response = Gallery::where('id', $id)->first();
            $response->update([
                'gal_titulo' => $request['gal_titulo'],
                'gal_foto' => $save_url,
                'gal_descripcion' => $request['gal_descripcion']

            ]);
        return $response;


    }

    function GalleryDelete(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $id = $data['id'];

            $gallery_delete = Gallery::where('id', $id)->first();

            if (empty($gallery_delete)){
                return response()->json(['response' => false], 401);
            }else{
                $gallery_delete->delete();
                return response()->json(['response' => true], 200);
            }
        }
    }

}
