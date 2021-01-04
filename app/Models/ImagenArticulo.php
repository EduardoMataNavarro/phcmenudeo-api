<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenArticulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'articulo_id',
        'Path',
        'Type',
    ];
    public function Articulo(){
        return $this->belongsTo('App\Models\Articulo');
    }
}
