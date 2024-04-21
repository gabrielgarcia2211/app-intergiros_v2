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

    public function listValues($key)
    {
        try {
            $key = explode(',', $key);
            $values = MasterCombos::select(
                'master_combos.code'
            )->whereIn('id', $key);

            return $values->pluck('code');
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
