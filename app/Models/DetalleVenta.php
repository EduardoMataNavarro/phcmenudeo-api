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
        'Monto'
    ];
    public function Venta(){
        return $this->belongsTo('App\Models\Venta');
    }
}
