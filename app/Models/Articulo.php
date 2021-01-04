<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'SKU',
        'Nombre',
        'ClaveFabricante',
        'Descripcion',
        'Precio',
        'PrecioMayoreo',
        'CantidadMayoreo',
        'Color',
        'Tecnologia',
        'ficheTecnicaUrl',
        'Activo',
        'categoria_id',
        'marca_id',
    ];
    public function Imagenes(){
        return $this->hasMany('App\Models\ImagenArticulo');
    }
    public function Categoria(){
        return $this->belongsTo('App\Models\CategoriaArticulo');
    }
    public function Marca(){
        return $this->belongsTo('App\Models\Marca');
    }
}
