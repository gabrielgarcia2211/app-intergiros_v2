<?php

namespace App\Models\Terceros;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuration\MasterCombos;

class Tercero extends Model
{
    protected $table = 'terceros';

    protected $fillable = [
        'alias',
        'nombre',
        'documento',
        'tipo_documento_id',
        'user_id',
        'tipo_tercero_id',
        'banco',
        'cuenta',
        'pago_movil',
        'correo',
        'celular',
        'pais_id',
        'pais_telefono_id',
        'path_documento',
    ];

    const RELATIONS = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo_documento()
    {
        return $this->belongsTo(MasterCombos::class, 'tipo_documento_id');
    }

    public function tipo_tercero()
    {
        return $this->belongsTo(MasterCombos::class, 'tipo_tercero_id');
    }

    public function pais()
    {
        return $this->belongsTo(MasterCombos::class, 'pais_id');
    }

    public function pais_telefono()
    {
        return $this->belongsTo(MasterCombos::class, 'pais_telefono_id');
    }
}