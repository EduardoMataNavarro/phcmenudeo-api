<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'Articulos',
    ];
    public function Detalles(){
        return $this->hasMany('App\Models\CarritoDetalles');
    }
}
