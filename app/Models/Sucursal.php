<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clave',
        'Nombre',
        'Telefono',
        'Direccion',
        'estado_id',
    ];

    public function Estado(){
        return $this->belongsTo('App\Models\Estado');
    }
}
