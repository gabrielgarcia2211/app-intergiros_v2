<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\TipoEntidad;
use App\Models\Administracion\TipoFormulario;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TasaCambio extends Model
{
    use HasFactory;

    protected $table = 'tasa_cambio';

    protected $fillable = [
        'valor',
        'entidad_id',
        'tipo_formulario_id',
    ];

    const RELATION_SHIPS = ['tipo_formulario', 'tipo_entidad'];

    public function tipo_formulario()
    {
        return $this->belongsTo(TipoFormulario::class, 'tipo_formulario_id');
    }

    public function tipo_entidad()
    {
        return $this->belongsTo(TipoEntidad::class, 'entidad_id');
    }
}
