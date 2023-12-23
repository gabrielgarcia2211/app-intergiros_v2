<?php

namespace App\Models\Administracion;

use App\Models\Administracion\TasaCambio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoFormulario extends Model
{
    use HasFactory;

    protected $table = 'tipo_formulario';

    protected $fillable = [
        'descripcion',
        'codigo',
    ];

    public function tasa_cambios()
    {
        return $this->hasOne(TasaCambio::class, 'tipo_formulario_id');
    }

}
