<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\DetalleInventario;

class InventarioController extends Controller
{
    //
    public function Create(Request $request) {
        $clave = $request->input('clave');
        $articulo = $request->input('articulo');
        $sucursal = $request->input('sucursal');
        $cantidad = $request->input('cantidad');

        $newInventario = Inventario::create([
            'Clave' => $clave,
            'Sucursal' => $sucursal,
            'Articulo' => $articulo,
            'Cantidad' => $cantidad,
        ]);
        $newInventario->save();

        return response()->json($newInventario);
    }

    public function Edit(Request $request) {
        $inventarioid = input('inventarioid');
        $clave = $request->input('clave');
        $articulo = $request->input('articulo');
        $sucursal = $request->input('sucursal');
        $cantidad = $request->input('cantidad');

        $inventario = Inventario::find($inventarioid);
        $inventario->Clave = $clave;
        $inventario->sucursal_id = $sucursal;
        $inventario->articulo_id = $articulo;
        $inventario->Cantidad = $cantidad;
        $inventario->save();

        return response()->json($inventario);
    }
    
    public function GetMovimientos($id){
        $inventario = Inventario::find($id)->with('DetalleInventario');
        return response()->json($inventario);
    }

    public function CreateMovimiento(Request $request) {
        $inventarioid = $request->input('inventarioid');
        $tipomovimiento = $request->input('tipomovimiento');
        $cantidad = $request->input('cantidad');

        $inventario = Inventario::find($inventarioid);
        if ($inventario) {
            if ($inventario == 'entrada') {
                $inventario->Cantidad += $cantidad;
            }
            if ($inventario == 'salida') {
                $inventario->Cantidad -= $cantidad;
            }
            $inventario->save();
            $newMovimiento = MovimientoInventario::create([
                'inventario_id' => $inventario->id,
                'Tipo' => $tipomovimiento,
                'Cantidad' => $cantidad,
            ]);
            $newMovimiento->save();
            $inventarioDetails = $inventario->Movimientos;
            return response()->json(['message' => 'success', 'inventario' => $inventarioDetails]);
        }
    }
}
