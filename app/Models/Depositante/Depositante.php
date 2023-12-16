<?php

namespace App\Models\Depositante;


use Illuminate\Database\Eloquent\Model;

class Depositante extends Model
{
    protected $table = 'depositantes';

    protected $fillable = [
        'alias',
        'nombre',
        'documento',
        'correo',
        'celular',
        'pais_id',
        'tipo_documento_id',
        'pais_telefono_id',
        'user_id',
    ];
}
