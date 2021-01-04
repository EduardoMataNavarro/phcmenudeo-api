<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clave',
        'Nombre',
        'Capital',
        'sucursal_id',
    ];
    public function Sucursal(){
        return $this->hasOne('App\Models\Sucursal');
    }
}
