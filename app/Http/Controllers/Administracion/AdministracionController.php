<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\TipoFormulario;
use App\Http\Controllers\ResponseController as Response;

class AdministracionController extends Controller
{
    public function getForms($principal)
    {
        return TipoFormulario::where([
            'principal' => $principal
        ])->get();
    }

    public function getMonedas()
    {
        return TipoMoneda::all();
    }
}
