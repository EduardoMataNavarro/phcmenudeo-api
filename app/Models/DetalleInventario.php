<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleInventario extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventario_id',
        'Tipo',
        'Cantidad',
    ];
    public function Detalles(){
        return $this->belongsTo('App\Models\Inventario');
    }
}
