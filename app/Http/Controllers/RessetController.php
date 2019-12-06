<?php

namespace App\Http\Controllers;

use App\Resset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RessetController extends Controller
{
    function restar(Request $request){
        if ($request->isJson()){
            $data = $request['code'];
            $code = Resset::where('code', $data)->first();
            if (empty($code)){
                return response()->json(['message' => 'El código es incorrecto'], 401);
            }else{
                $user_email = $code['email'];

                DB::table('usuarios')
                    ->where('usu_email', $user_email)
                    ->update([
                        'usu_pass' => Hash::make(12345),
                    ]);

                $restar_delete = Resset::where('code', $data)->first();
                $restar_delete->delete();
                return response()->json(['response' => true], 200);

            }
        }else{
            return response()->json(['response' => false], 401);
        }

    }
}
