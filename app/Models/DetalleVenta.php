<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'venta_id',
        'articulo_id',
        'sucursal_id',
        'Cantidad',
        'DireccionEnvio',
        'Monto'
    ];
    public function Venta(){
        return $this->belongsTo('App\Models\Venta');
    }
    public function Articulo(){
        return $this->belongsTo('App\Models\Articulo');
    }
    public function Sucursal(){
        return $this->belongsTo('App\Models\Sucursal');
    }
}
