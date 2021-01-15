<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Carrito;
use App\Models\MetodoEnvio;
use App\Models\MetodoPago;
use App\Models\Inventario;
use App\Models\DetalleInventario;

class VentaController extends Controller
{
    //
    public function Index() {
        $ventas = Venta::with('Usuario')->get();
        return response()->json($ventas);
    }
    public function GetById($id) {
        $venta = Venta::find($id);
        return response()->json($venta);
    }
    public function Create(Request $request) {
        $userid = $request->input('userid');
        $detalle = $request->input('detalle');

        $newVenta = Venta::create([
            'user_id' => $userid,
            'Subtotal' => 0,
            'Total' => 0,
            'Estatus' => 'iniciada',
        ]);
        $newVenta->save();
        $newVenta->Folio = str_pad((string)$newVenta->id, 8, '0', STR_PAD_LEFT);
        $newVenta->save();
        
        $articuloid = $detalle['articuloid'];
        $cantidad = $detalle['cantidad'];
        $sucursalid = $detalle['sucursalid'];

        $articulo = Articulo::find($articuloid);
        $monto = $cantidad * (($articulo->CantidadMayoreo >= $cantidad) ? $articulo->PrecioMayoreo : $articulo->Precio);

        $newDetalleVenta = DetalleVenta::create([
            'venta_id' => $newVenta->id,
            'articulo_id' => $articuloid,
            'sucursal_id' => $sucursalid,
            'Cantidad' => $cantidad,
            'Monto' => $monto,
        ]);
        $newDetalleVenta->save();
        
        $newVenta->Subtotal = $monto;
        $newVenta->Total = $monto;
        $newVenta->save();

        return response()->json($newVenta);
    }
    public function Edit(Request $request) {
        $ventaid = $request->input('ventaid');
        $metodoenvioid = $request->input('metodoenvioid');
        $metodopagoid = $request->input('metodopagoid');
        $direccionEnvio = $request->input('direccionEnvio');
        $estatus = $request->input('estatus');

        $venta = Venta::find($ventaid);
        if ($venta) {
            /* Calcular el subtotal de los articulos en la venta */
            $subtotal = 0;
            $detalles = DetalleVenta::where('venta_id', $venta->id)->get();
            foreach ($detalles as $detalle) {
                $articulo = Articulo::find($detalle->articulo_id);
                /* Determina el precio que tomará el articulo dependiendo de la cantidad en el detalle de la venta */
                $subtotal += $detalle->Cantidad * (($detalle->Cantidad >= $articulo->CantidadMayoreo) ? $articulo->PrecioMayoreo : $articulo->Precio);
            }
            $venta->Subtotal = $subtotal;
            $venta->Total = $subtotal;
            $venta->save();

            if ($metodoenvioid) {
                $metodoenvio = MetodoEnvio::find($metodoenvioid);
                $venta->metodoenvio_id = $metodoenvio->id;
                $venta->Total += $metodoenvio->Cuota;
                $venta->DireccionEnvio = $direccionEnvio;
                $venta->save();
            }
            if ($metodopagoid) {
                $metodopago = MetodoPago::find($metodopagoid);
                $venta->metodopago_id = $metodopago->id;
                $venta->Total += $metodopago->Cuota;
                $venta->save();
            }
            $venta->Estatus = $estatus;
            $venta->save();
            
            return response()->json(Venta::with('MetodoEnvio')
                                    ->with('MetodoPago')
                                    ->where('id', $venta->id)->first());
        }
        else {
            return response()->json(['message' => 'No se encontró la venta']);
        }
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
    public function GetDetalles($ventaid) {
        $detalles = DetalleVenta::where('venta_id', $ventaid)->get();
        return response()->json($detalle);
    }

    public function Check(Request $request) {
        $ventaid = $request->input('compraid');
        $userid = $request->input('usuarioid');

        $venta = Venta::find($ventaid);
        if ($venta) {
            if ($venta->user_id == $userid) {
                $ventaDetalles = $venta->with('MetodoPago')
                                        ->with('MetodoEnvio')
                                        ->with('Usuario')
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
    public function ConfirmAndMail(Request $request) {
        $ventaid = $request->input('ventaid');

        $venta = Venta::find($ventaid);
        $vtaDetalles = $venta->with('Detalles')->where('id', $venta->id)->first();
        if ($venta->Estatus != 'terminada') {
            $venta->Estatus = 'terminada';
            $venta->save();
            foreach ($vtaDetalles->detalles as $detalle) {
                $inventario = Inventario::where('articulo_id', $detalle->articulo_id)
                                            ->where('sucursal_id', $detalle->sucursal_id)->first();
                $salidaInventario = DetalleInventario::create([
                    'inventario_id' => $inventario->id,
                    'Tipo' => 'salida',
                    'Cantidad' => $detalle->Cantidad,
                ]);
                $salidaInventario->save();
            }
        }
        return response()->json($vtaDetalles);
    }
}
