<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\MasterCombos;
use App\Http\Controllers\ResponseController as Response;

class ConfigurationController extends Controller
{

    public function listChildrens($name)
    {
        try {
            return MasterCombos::getChildrens($name);
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
