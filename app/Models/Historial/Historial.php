<?php

namespace App\Models\Historial;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';

    protected $fillable = [
        'solicitud_id',
        'beneficiario_id',
        'comentarios',
        'opciones',
        'path_estado_cuenta'
    ];

    const RELATIONS = [];
}
