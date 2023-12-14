<?php

namespace App\Models\Beneficiario;


use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'beneficiario';

    protected $fillable = [
        'alias',
        'nombre',
        'documento',
        'banco',
        'cuenta',
        'pago_movil',
        'tipo_documento_id',
        'user_id'
    ];
}
