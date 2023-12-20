<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoEntidad extends Model
{
    use HasFactory;

    protected $table = 'tipo_entidad';

    protected $fillable = [
        'descripcion',
    ];

    const RELATION_SHIPS = [''];

}
