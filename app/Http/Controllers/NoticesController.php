<?php

namespace App\Http\Controllers;

use App\Notices;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Mockery\Matcher\Not;

class NoticesController extends BaseController
{
    function ultimateNotices(Request $request){
        if ($request->isJson()){
            try{
                //$data = new Notices();
                $data = Notices::orderBy('id', 'desc')->get();

                return response()->json($data, 200);


            }catch (ModelNotFoundException $e){
                return response()->json(['response' => false, 401]);
            }
        }else{
            return response()->json(['response' => false, 401]);
        }
    }
}
