<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoEnvio;

class MetodoEnvioController extends Controller
{
    //
    public function Index() {
        $metodosenvio = MetodoEnvio::all();
        return response()->json($metodosenvio);
    }

    public function Create(Request $request) {
        $nombre = $request->input('nombre');
        $clave = $request->input('clave');
        $descripcion = $request->input('descripcion');
        $cuota = $request->input('cuota');

        $newMetodoEnvio = MetodoEnvio::create([
            'Nombre' => $nombre,
            'Clave' => $clave,
            'Cuota' => $cuota,
            'Descripcion' => $descripcion,
        ]);
        $newMetodoEnvio->save();

        return response()->json($newMetodoEnvio);
    }

    public function Edit(Request $request) {
        $metodoenvioid = $request->input('metodoenvioid');
        $nombre = $request->input('nombre');
        $clave = $request->input('clave');
        $descripcion = $request->input('descripcion');
        $cuota = $request->input('cuota');

        $metodoEnvio = MetodoEnvio::find($metodoenvioid);
        if ($metodoEnvio) {
            $metodoEnvio->Nombre = $nombre;
            $metodoEnvio->Clave = $clave;
            $metodoEnvio->Cuota = $cuota;
            $metodoEnvio->Descripcion = $descripcion;
            $metodoEnvio->save();
            
            return response()->json($metodoEnvio);
        }
        else {
            return reponse()->json(['message' => 'No se ha encontrado el metodo de envio']);
        }
    }

    public function GetById($id) {
        $metodoenvio = MetodoEnvio::find($id);
        return response()->json($metodoenvio);
    }
}
