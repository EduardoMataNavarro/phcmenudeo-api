<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaArticulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clave',
        'Nombre',
        'Descripcion',
    ];

    public function Articulos(){
        return $this->hasMany('App\Models\Articulo');
    }
}
