<?php

namespace App\Models\Solicitudes;

use App\Models\Administracion\TipoFormulario;
use App\Models\Administracion\TipoMoneda;
use App\Models\Configuration\MasterCombos;
use App\Models\Terceros\Tercero;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'tipo_formulario_id',
        'tipo_moneda_id',
        'depositante_id',
        'beneficiario_id',
        'producto_id',
        'monto_a_pagar',
        'monto_a_recibir',
        'user_id',
        'estado_id',
    ];

    const RELATIONS = ['tipo_formulario', 'tipo_moneda', 'depositante', 'beneficiario', 'producto', 'user', 'estado'];

    public function tipo_formulario()
    {
        return $this->belongsTo(TipoFormulario::class);
    }

    public function tipo_moneda()
    {
        return $this->belongsTo(TipoMoneda::class);
    }

    public function depositante()
    {
        return $this->belongsTo(Tercero::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function beneficiario()
    {
        return $this->belongsTo(Tercero::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(MasterCombos::class);
    }
}
