<?php

namespace App\Http\Controllers;

use App\Notices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;
use Mockery\Matcher\Not;
use http\Env\Response;

class NoticesController extends BaseController
{
    function ultimateNotices(Request $request){
        if ($request->isJson()){
            try{
                //$data = new Notices();
                $data = Notices::orderBy('id', 'desc')
                    ->limit(10)
                    ->get();

                return response()->json($data, 200);


            }catch (ModelNotFoundException $e){
                return response()->json(['response' => false], 401);
            }
        }else{
            return response()->json(['response' => false], 401);
        }
    }

    function addNotices(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $clave = time() . Str::random(10);

            $addNot = Notices::create([
                'not_clave' => $clave,
                'not_nombre' => $data['not_nombre'],
                'not_descripcion' => $data['not_descripcion']
            ]);
            return $addNot;
        }else{
            return json_encode(['response' => false], 401);
        }
    }

    function updateNotices(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $updateNotices = Notices::where('id', $data['id'])->first();

            if (empty($updateNotices)){
                return response()->json(['response' => false], 401);
            }else{
                $updateNotices->update($data);
                return $updateNotices;
            }

            return $updateNotices;
        }else{
            return json_encode(['response' => false], 404);
        }
    }

    function DeleteNotices(Request $request){
        if ($request->isJson()){
            $data = $request->json()->all();
            $delete = Notices::where('id', $data['id'])->first();
            if (empty($delete)){
                return json_encode(['response' => false], 401);
            }else{
                $delete->delete($data);
                return response()->json(['response' => true], 200);
            }
        }else{
            return json_encode(['response' => false], 401);
        }
    }
}
