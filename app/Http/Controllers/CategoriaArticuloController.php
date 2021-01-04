<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaArticulo;

class CategoriaArticuloController extends Controller
{
    //
    public function Index(){
        $categoriaArticulos = CategoriaArticulo::all();
        return response()->json($categoriaArticulos);
    }

    public function GetById($id){
        $categoriaArticulo = CategoriaArticulo::find($id);
        return response()->json($categoriaArticulo);
    }

    public function Create(Request $request){
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $newCategoriaArticulo = CategoriaArticulo::create([
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Descripcion' => $descripcion,
        ]);
        $newCategoriaArticulo->save();
        return response()->json($newCategoriaArticulo);
    }

    public function Edit(Request $request){
        $categoriaArticuloid = $request->input('categoriaid');
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $categoriaArticulo = CategoriaArticulo::find($categoriaArticuloid);
        $categoriaArticulo->Clave = $clave;
        $categoriaArticulo->Nombre = $nombre;
        $categoriaArticulo->Descripcion = $descripcion;
        $categoriaArticulo->save();

        return response()->json($categoriaArticulo);
    }
}
