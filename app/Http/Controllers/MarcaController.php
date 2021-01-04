<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    //
    public function Index(){
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    public function GetById($id){
        $marca = Marca::find($id);
        return response()->json($marca);
    }

    public function Create(Request $request){
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $newMarca = Marca::create([
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Descripcion' => $descripcion,
        ]);
        $newMarca->save();
        return response()->json($newMarca);
    }

    public function Edit(Request $request){
        $marcaid = $request->input('marcaid');
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');

        $marca = Marca::find($marcaid);
        $marca->Clave = $clave;
        $marca->Nombre = $nombre;
        $marca->Descripcion = $descripcion;
        $marca->save();

        return response()->json($marca);
    }
}
