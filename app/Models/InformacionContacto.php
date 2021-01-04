<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionContacto extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nombre',
        'Puesto',
        'Direccion',
        'Email',
        'Telefono',
        'TelefonoMovil',
    ];
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
