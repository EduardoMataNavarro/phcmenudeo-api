<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clave',
        'sucursal_id',
        'articulo_id',
        'Cantidad',
    ];

    public function Detalles(){
        return $this->hasMany('App\Models\DetalleInventario');
    }
}
