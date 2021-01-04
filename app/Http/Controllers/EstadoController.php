<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    //
    public function Index(){
        $estados = Estado::all();
        return response()->json($estados);
    }

    public function GetById($id){
        $estado = Estado::find($id);
        return response()->json($estado);
    }

    public function Create(Request $request){
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $capital = $request->input('capital');
        $sucursal = $request->input('sucursal');

        $newEstado = Estado::create([
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Capital' => $capital,
            'sucursal_id' => $sucursal,
        ]);
        $newEstado->save();
        return response()->json($newEstado);
    }

    public function Edit(Request $request){
        $estadoid = $request->input('estadoid');
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $capital = $request->input('capital');
        $sucursal = $request->input('sucursal');

        $estado = Estado::find($estadoid);
        $estado->Clave = $clave;
        $estado->Nombre = $nombre;
        $estado->Capital = $capital;
        $estado->sucursal_id = $sucursal;
        $estado->save();

        return response()->json($estado);
    }
}
