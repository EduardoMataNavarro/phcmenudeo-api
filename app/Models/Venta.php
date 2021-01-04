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
        'Total', 
        'metodoenvio_id',
        'metodopago_id'
    ];

    public function Detalles(){
        return $this->hasMany('App\Models\DetalleVenta');
    }
}
