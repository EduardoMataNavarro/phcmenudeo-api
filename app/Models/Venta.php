<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'Folio',
        'Subtotal',
        'Total',
        'DireccionEnvio',
        'Estatus', 
        'metodoenvio_id',
        'metodopago_id'
    ];

    public function Detalles(){
        return $this->hasMany('App\Models\DetalleVenta');
    }
    public function Usuario(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function MetodoEnvio(){
        return $this->belongsTo('App\Models\MetodoEnvio', 'metodoenvio_id', 'id');
    }
    public function MetodoPago(){
        return $this->belongsTo('App\Models\MetodoPago', 'metodopago_id', 'id');
    }
}
