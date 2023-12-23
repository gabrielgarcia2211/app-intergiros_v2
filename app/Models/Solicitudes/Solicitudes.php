<?php

namespace App\Models\Solicitudes;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'tipo_formulario_id',
        'tipo_moneda_id',
        'tercero_id',
        'user_id',
        'estado_id',
    ];
}
