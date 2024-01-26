<?php

namespace App\Models\Solicitudes;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'costoBase',
        'rangoMin',
        'rangoMax'
    ];

    const RELATIONS = [];
}
