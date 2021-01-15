<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function GetTopArticulos(){
        $articulos = DetalleVenta::selectRaw('sum(detalle_ventas.Cantidad) as Cantidad, 
                                            sum(detalle_ventas.Monto) as TotalComprados,
                                            articulos.id,
                                            articulos.SKU, 
                                            articulos.Nombre,
                                            articulos.Precio,
                                            articulos.PrecioMayoreo')
                                    ->join('articulos', 'articulos.id', '=', 'detalle_ventas.articulo_id')
                                    ->groupBy('articulos.id')
                                    ->groupBy('articulos.SKU')
                                    ->groupBy('articulos.Nombre')
                                    ->orderBy('Cantidad')->limit(5)->get();
        return response()->json($articulos);
    }

    public function GetTotalMes() {
        $totales = Venta::selectRaw('count(ventas.id) as CantidadVentas,
                                       sum(ventas.Total) as TotalVentas,
                                       sum(ventas.Subtotal) as SubtotalVentas')
                                       ->whereMonth('ventas.created_at', now()->month)
                                       ->whereYear('ventas.created_at', now()->year)->get();
        return response()->json($totales);
    }

    public function GetTotalCompras() {
        $totales = Venta::selectRaw('count(ventas.id) as CantidadVentas,
                                       sum(ventas.Total) as TotalVentas,
                                       sum(ventas.Subtotal) as SubtotalVentas')->get();
        return response()->json($totales);
    }
}
