<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    //
    public function Index(){
        $sucursals = Sucursal::all();
        return response()->json($sucursals);
    }

    public function GetById($id){
        $sucursal = Sucursal::find($id);
        return response()->json($sucursal);
    }

    public function Create(Request $request){
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $direccion = $request->input('capital');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $estado = $request->input('estado');

        $newSucursal = Sucursal::create([
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Telefono' => $telefono,
            'Direccion' => $direccion,
            'estado_id' => $estado,
        ]);
        $newSucursal->save();
        return response()->json($newSucursal);
    }

    public function Edit(Request $request){
        $sucursalid = $request->input('sucursalid');
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $estado = $request->input('estado');

        $sucursal = Sucursal::find($sucursalid);
        $sucursal->Clave = $clave;
        $sucursal->Nombre = $nombre;
        $sucursal->Direccion = $direccion;
        $sucursal->Telefono = $telefono;
        $sucursal->estado_id = $estado;
        $sucursal->save();

        return response()->json($sucursal);
    }
}
