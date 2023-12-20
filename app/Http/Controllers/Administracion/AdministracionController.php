<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController as Response;
use App\Models\Administracion\TipoFormulario;
use App\Models\Administracion\TipoMoneda;

class AdministracionController extends Controller
{
    public function getForms()
    {
        return TipoFormulario::all();
    }

    public function getMonedas()
    {
        return TipoMoneda::all();
    }
}
