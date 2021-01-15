<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoDetalles;

class CarritoDetallesController extends Controller
{
    //
    public function Edit(Request $request) {
        $detalleid = $request->input('detalleid');
        $cantidad = $request->input('cantidad');
        $sucursalid = $request->input('sucursalid');

        $detalle = CarritoDetalles::find($detalleid);
        $detalle->Cantidad = $cantidad;
        $detalle->sucursal_id = $sucursalid;
        $detalle->save();

        return response()->json($detalle);
    }

    public function GetByCarrito($id) {
        $detalles = CarritoDetalles::where('carrito_id', $id)->get();
        if (count($detalles) > 0) {
            return response()->json($detalles);
        }
        else {
            return reponse()->json(['message' => 'Su carrito está vacío']);
        }
        return response()->json($detalles);
    }

    public function Delete($id) {
        $detalle = CarritoDetalles::find($id);
        if ($detalle) {
            if ($detalle->delete()) {
                return response()->json(['message' => 'Se ha eliminado un articulo de su carrito']);
            }
            else {
                return response()->json(['message' => 'No se ha eliminado el articulo']);
            }
        }
        else {
            return response()->json(['message' => 'El articulo ya se eliminó de su carrito']);
        }
    }
}
