<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\CarritoDetalles;
use App\Models\User;

class CarritoController extends Controller
{
    //
    public function AddToCart(Request $request) {
        $userid = $request->input('userid');
        $articuloid = $request->input('articuloid');

        $carrito = Carrito::where('user_id', $userid)->first();
        $usuario = User::find($userid);
        if (!$carrito) {
            $newCarrito = Carrito::create([
                'user_id' => $userid,
                'Articulos' => 1,
            ]);
            $newCarrito->save();

            $newCarritoDetalle = CarritoDetalles::create([
                'carrito_id' => $newCarrito->id,
                'articulo_id' => $articuloid,
                'Cantidad' => 1,
                'sucursal_id' => $usuario->sucursal_id,
            ]);
            $newCarritoDetalle->save();
            
            return response()->json(['message' => 'Articulo agregado al carrito']);
        }
        else {
            $detalleCarrito = CarritoDetalles::where('carrito_id', $carrito->id)
                                                ->where('articulo_id', $articuloid)->first();
            if (!$detalleCarrito) {
                $newCarritoDetalle = CarritoDetalles::create([
                    'carrito_id' => $carrito->id,
                    'articulo_id' => $articuloid,
                    'sucursal_id' => $usuario->sucursal_id,
                    'Cantidad' => 1,
                ]);
                return response()->json(['message' => 'Articulo agregado al carrito']);
            }
            else {
                return response()->json(['message' => 'El articulo ya está en el carrito']);
            }
        }
    }

    public function GetDetalles($id) {
        $detalles = Carrito::where('usuario_id', $id)
                            ->with('Detalles')->get();
        return response()->json($detalles);
    }
    
    public function GetByUser($userid) {
        $carrito = Carrito::where('user_id', $userid)->first();
        if ($carrito) {
            $carritoDetalles = CarritoDetalles::where('carrito_id',$carrito->id)->get();
            if (count($carritoDetalles) > 0) {
                return response()->json($carritoDetalles);
            }
            else {
                return response()->json(['message' => 'No tiene articulos en su carrito']);
            }
        }
        else {
            return response()->json(['message' => 'No tiene articulos en su carrito']);
        }
    }
}
