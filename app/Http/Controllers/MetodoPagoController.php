<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{
    //
    public function Index() {
        $metodospago = MetodoPago::all();
        return response()->json($metodospago);
    }

    public function Create(Request $request) {
        $nombre = $request->input('nombre');
        $clave = $request->input('clave');
        $descripcion = $request->input('descripcion');
        $cuota = $request->input('cuota');

        $newMetodoPago = MetodoPago::create([
            'Nombre' => $nombre,
            'Clave' => $clave,
            'Cuota' => $cuota,
            'Descripcion' => $descripcion,
        ]);
        $newMetodoPago->save();

        return response()->json($newMetodoPago);
    }

    public function Edit(Request $request) {
        $metodopagoid = $request->input('metodopagoid');
        $nombre = $request->input('nombre');
        $clave = $request->input('clave');
        $descripcion = $request->input('descripcion');
        $cuota = $request->input('cuota');

        $metodoPago = MetodoPago::find($metodopagoid);
        if ($metodoPago) {
            $metodoPago->Nombre = $nombre;
            $metodoPago->Clave = $clave;
            $metodoPago->Cuota = $cuota;
            $metodoPago->Descripcion = $descripcion;
            $metodoPago->save();
            
            return response()->json($metodoPago);
        }
        else {
            return reponse()->json(['message' => 'No se ha encontrado el metodo de envio']);
        }
    }

    public function GetById($id) {
        $metodoPago = MetodoPago::find($id);
        return response()->json($metodoPago);
    }
}
