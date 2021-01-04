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
        
        return response()->json($newVenta);
    }

    public function CreateFromCart(Request $request) {
        $cartid = $request->input('carritoid');
        $carrito = Carrito::find($cartid)->with('Detalles');
    }
}
