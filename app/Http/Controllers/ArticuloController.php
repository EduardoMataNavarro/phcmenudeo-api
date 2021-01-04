<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\ImagenArticulo;
use App\Models\CategoriaArticulo;

class ArticuloController extends Controller
{
    //
    public function Index(){
        $articulos = Articulo::all();
        return response()->json($articulos);
    }

    public function GetById($id){
        $articulo = Articulo::find($id)->With('Imagenes')->where('id', $id)->get();
        return response()->json($articulo);
    }

    public function Find($term){
        if ($term != '') {
            $nTerm = Str::lower($term);
            $queryResult = Articulo::where('articulos.Nombre', 'like', '%' . $nTerm . '%')
                                    ->orWhere('articulos.Descripcion', 'like', '%' . $nTerm . '%')
                                    ->with('Marca')
                                    ->with('Categoria')
                                    ->with('Imagenes')->get();
            
            return response()->json([$queryResult]);
        }
    }

    public function Create(Request $request){
        $SKU = $request->input('clave');
        $ClaveProveedor = $request->input('claveProveedor');
        $Nombre = $request->input('nombre');
        $Precio = $request->input('precio');
        $PrecioMayoreo = $request->input('precioMayoreo');
        $CantidadMayoreo = $request->input('cantidadMayoreo');
        $Descripcion = $request->input('descripcion');
        $Color = $request->input('color');
        $Tecnologia = $request->input('tecnologia');
        $Categoria = $request->input('categoria');
        $Marca = $request->input('marca');
        $Activo = $request->input('activo');
        
        $newArticulo = Articulo::create([
            'SKU' => $SKU,
            'ClaveFabricante' => $ClaveProveedor,
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'PrecioMayoreo' => $PrecioMayoreo,
            'Color' => $Color,
            'Tecnologia' => $Tecnologia,
            'CantidadMayoreo' => $CantidadMayoreo,
            'categoria_id' => $Categoria,
            'marca_id' => $Marca,
            'Activo' => $Activo,
        ]);
        $newArticulo->save();
        
        if ($request->hasFile('fichaTecnica')) {
            $ficha = $request->file('fichaTecnica');
            $fichaPath = $ficha->store('product-files', 's3');
            $fichaAPath = env('AWS_URL') . '/' . $fichaPath;
            $newArticulo->ficheTecnicaUrl = $fichaAPath;
            $newArticulo->save();
        }

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {

                $path = $image->store('product-images', 's3');
                $mediapath = env('AWS_URL') . '/' . $path;
                $mediatype = $image->getClientOriginalExtension();
                $newImagenArticulo = ImagenArticulo::create([
                    'articulo_id' => $newArticulo->id,
                    'Type' => $mediatype,
                    'Path' => $mediapath,
                ]);
                $newImagenArticulo->save();
            }
        }
        return response()->json($newArticulo);
    }

    public function UploadSingleImage(Request $request) {
        $articuloid = $request->input('articuloid');


        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $mediatype = $media->getClientOriginalExtension();
            $folder = 'tests';
            $path = $request->file('media')->store($folder, 's3');
            $mediapath = env('AWS_URL') . '/' . $path;
            
            $newImagenArticulo = ImagenArticulo::create([
                'articulo_id' => $articuloid,
                'Type' => $mediatype,
                'Path' => $mediapath,
            ]);
            $newImagenArticulo->save();
            return response()->json($newImagenArticulo);
        }
        else 
            return response()->json('No se encontro ningun archivo');
    }
}
