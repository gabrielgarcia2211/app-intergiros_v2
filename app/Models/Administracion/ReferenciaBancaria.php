<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferenciaBancaria extends Model
{
    use HasFactory;

    protected $table = 'referencias_bancarias';

    protected $fillable = [
        'pais',
        'banco',
        'titular',
        'tipo',
        'numero',
        'especial',
        'otros',
        'tipo_moneda_id'
    ];

    public function tipo_moneda()
    {
        return $this->belongsTo(TipoMoneda::class);
    }
}
