<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    //
    public function Index(){
        return response()->json(Rol::all());
    }

    public function Create(Request $request) {
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $peso = $request->input('peso');

        $newRol = Rol::create([
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Descripcion' => $descripcion,
            'Peso' => $peso,
        ]);
        $newRol->save();

        return response()->json($newRol);
    }

    public function GetById($id) {
        return response()->json(Rol::find($id));
    }

    public function Edit(Request $request) {
        $rolid = $request->input('rolid');
        $clave = $request->input('clave');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $peso = $request->input('peso');

        $rol = Rol::find($rolid);
        if ($rol) {
            $rol->Clave = $clave;
            $rol->Nombre = $nombre;
            $rol->Descripcion = $descripcion;
            $rol->Peso = $peso;
            $rol->save();

            return response()->json($rol);
        }
        else {
            return response()->json(['message' => 'No se pudo encontrar el rol']);
        }
    }
}
