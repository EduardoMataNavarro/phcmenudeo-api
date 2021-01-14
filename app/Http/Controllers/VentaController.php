<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Carritos;

class VentaController extends Controller
{
    //
    public function Create(Request $request) {
        $userid = $request->input('userid');
        $detalle = $request->input('detalle');

        $newVenta = Venta::create([
            'user_id' => $userid,
            'Total' => 0,
            'Estatus' => 'iniciada',
        ]);
        $newVenta->save();
        $newVenta->Folio = str_pad((string)$newVenta->id, 8, '0', STR_PAD_LEFT);
        $newVenta->save();

        $articulo = Articulo::find($detalle->articulo_id);
        $cantidad = $detalle->Cantidad;
        $monto = $cantidad * (($articulo->CantidadMayoreo >= $cantidad) ? $articulo->PrecioMayoreo : $articulo->Precio);

        $newDetalleVenta = DetalleVenta::create([
            'venta_id' => $newVenta->id,
            'articulo_id' => $detalle->articulo_id,
            'sucursal_id' => $detalle->sucursal_id,
            'Monto' => $monto,
        ]);
        $newDetalleVenta->save();
        
        $newVenta->Total = $monto;
        $newVenta->save();

        return response()->json($newVenta);
    }
    public function Edit(Request $request) {

    }

    public function CreateFromCarrito(Request $request) {
        $cartid = $request->input('carritoid');
        $userid = $request->input('userid');
        $metodoenvioid = $request->input('metodoenvioid');
        $metodopagoid = $request->input('metodopagoid');

        $carrito = Carrito::find($cartid)->with('Detalles')->first();
        if ($carrito) {
            $newVenta = Venta::create([
                'user_id' => $userid,
                'metodopago_id' => $metodopagoid,
                'metodoenvio_id' => $metodoenvioid,
                'Total' => 0,
                'Estatus' => 'iniciada',
            ]);
            $newVenta->save();
    
            foreach ($carrito->Detalles as $detalle) {
                $sucursal = $detalle->sucursal_id;
                $articulo = Articulo::find($detalle->articulo_id);
                $cantidad = $detalle->Cantidad;
                $monto = $cantidad * (($articulo->CantidadMayoreo >= $cantidad) ? $articulo->PrecioMayoreo : $articulo->Precio);
    
                $newDetalleVenta = DetalleVenta::create([
                    'venta_id' => $newVenta->id,
                    'articulo_id' => $detalle->articulo_id,
                    'sucursal_id' => $detalle->sucursal_id,
                    'Monto' => $monto,
                ]);
                $newDetalleVenta->save();
    
                $newVenta->Total += $monto;
                $newVenta->save();
            }
            $metodoenvio = MetodoEnvio::find($metodoenvioid);
            $metodopago = MetodoPago::find($metodopagoid);
    
            $newVenta->Total += $metodoenvio->Cuota;
            $newVenta->Total += $metodopago->Cuota;
            $newVenta->save();
    
            $ventaDetalles = $newVenta->with('Detalles')->get();
            return response()->json(['id' => $ventaDetalles->id]);
        }
        else {
            return response()->json(['message' => 'No se pudo encontrar el carrito']);
        }
    }

    public function GetById(Request $request) {
        $ventaid = $request->input('compraid');
        $userid = $request->input('usuarioid');

        $venta = Venta::find($ventaid);
        if ($venta) {
            if ($venta->user_id == $userid) {
                $ventaDetalles = $venta->with('MetodoPago')
                                        ->with('MetodoEnvio')
                                        ->with('Detalles')
                                        ->where('id', $ventaid)->first();
                return response()->json($ventaDetalles);
            }
            else {
                return response()->json(['message' => 'Invalid']);
            }
        }
        else {
            return response()->json(['message' => 'NA']);
        }
    }
}
