<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoEnvio extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clave',
        'Nombre',
        'Descripcion',
        'Cuota',
    ];
}
