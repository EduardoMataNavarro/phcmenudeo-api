<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalles extends Model
{
    use HasFactory;
    protected $fillable = [
        'carrito_id',
        'articulo_id',
        'sucursal_id',
        'Cantidad',
    ];
    public function Carrito() {
        return $this->belongsTo('App\Models\Carrito');
    }
    public function Articulo() {
        return $this->hasOne('App\Models\Articulo');
    }
}
