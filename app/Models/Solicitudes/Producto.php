<?php

namespace App\Models\Solicitudes;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'servicio',
        'costo',
    ];

    const RELATIONS = [];
}
