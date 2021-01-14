<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class HomeController extends Controller
{
    //
    public function GetLatest($limit) {
        $articulos = Articulo::latest()->limit($limit);
        return response()->json($articulos->with('Imagenes')->get());
    }
}
