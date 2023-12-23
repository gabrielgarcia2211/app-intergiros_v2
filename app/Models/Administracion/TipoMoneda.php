<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoMoneda extends Model
{
    use HasFactory;

    protected $table = 'tipo_moneda';

    protected $fillable = [
        'tipo',
        'descripcion',
        'codigo',
    ];

}
