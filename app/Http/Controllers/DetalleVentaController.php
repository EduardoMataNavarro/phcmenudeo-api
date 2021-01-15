<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Articulo;

class DetalleVentaController extends Controller
{
    //
    public function Edit(Request $request) {
        $detalleid = $request->input('detalleid');
        $cantidad = $request->input('cantidad');
        $sucursalid = $request->input('sucursalid');

        $detalle = DetalleVenta::find($detalleid);
        $articulo = Articulo::find($detalle->articulo_id);

        $detalle->sucursal_id = $sucursalid;
        $detalle->Cantidad = $cantidad;
        $detalle->Monto = $detalle->Cantidad * (($detalle->Cantidad >= $articulo->CantidadMayoreo) ? $articulo->PrecioMayoreo : $articulo->Precio);
        $detalle->save();

        return response()->json($detalle);
    }

    public function GetDetalles($id) {
        $detalles = DetalleVenta::where('venta_id', $id)->with('Articulo')->with('Sucursal')->get();

        return response()->json($detalles);
    }
    public function Delete($id) {
        $detalle = DetalleVenta::find($id);
        $ventaDetalles = Venta::find($detalle->venta_id)->with('Detalles')->where('id', $detalle->venta_id)->first();
        if (count($venta->detalles) > 1) {
            if ($detalle->delete()) {
                return response(['message' => 'Se ha eliminado el detalle']);
            }
            else {
                return response()->json(['message' => 'No se ha elminado el detalle']);
            }
        }
        else {
            return response()->json(['message' => 'No se puede elminar el detalle de la venta']);
        }
    }
}
