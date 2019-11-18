<?php

namespace App\Http\Controllers;
use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function ProductsAll(Request $request){
        if ($request->isJson()){
            $productos = Products::all();
            return response()->json($productos, 200);
        }else{
            return response()->json(['response' =>false], 401);
        }

    }

    function ProductsAdd(Request $request){
        if ($request->hasFile('archivo')){

            $archivo = $request->file('archivo');
            $name = time().$archivo->getClientOriginalName();
            $save_url = 'http://'.$_SERVER['SERVER_NAME'].'/galeriaBack/storage/app/'.$archivo->storeAs('Productod', $name);

        }
        $data = $request->all();

        Products::create([
            'pro_titulo' => $data['pro_titulo'],
            'pro_descripcion' => $data['pro_descripcion'],
            'pro_foto' => $save_url
        ]);
        return response()->json(['response' => true], 200);
    }

    function productsDelete(Request $request)
    {
        if ($request->isJson()) {
            if ($request->isJson()) {
                $data = $request->json()->all();
                $select = Products::where('id', $data['id'])->first();

                if (empty($select)) {
                    return response()->json(['response' => false], 401);
                } else {
                    $select->delete();
                    return response()->json(['response' => true], 200);
                }
            } else {
                return response()->json(['response' => false], 401);
            }
        }
    }
}
