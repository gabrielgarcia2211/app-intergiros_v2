<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoMoneda;
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

    public function getBancoByMoneda(TipoMoneda $TipoMoneda)
    {
        try {
            $response = MasterCombos::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('master_combos')
                    ->where('code', 'banco');
            })
                ->where([
                    ['status', '=', true],
                    ['valor1', '=', $TipoMoneda->codigo]
                ])
                ->orderBy('orden', 'asc')
                ->get();

            return $response;
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getTDByMoneda(TipoMoneda $TipoMoneda)
    {
        try {
            $response = MasterCombos::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('master_combos')
                    ->where('code', 'tipo_documento');
            })
                ->where([
                    ['status', '=', true],
                    ['valor1', '=', $TipoMoneda->codigo]
                ])
                ->orderBy('orden', 'asc')
                ->get();

            return $response;
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getBancosByCodigo($moneda)
    {
        try {
            $monedas = TipoMoneda::whereIn('codigo', explode(",", $moneda))->pluck('codigo')->unique()->toArray();
            $response = MasterCombos::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('master_combos')
                    ->where('code', 'banco');
            })
                ->where([
                    ['status', '=', true],
                ])
                ->whereIn('valor1', $monedas)
                ->orderBy('orden', 'asc')
                ->get();
            return $response;
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getDocumentoByMoneda($moneda)
    {
        try {
            $monedas = TipoMoneda::whereIn('codigo', explode(",", $moneda))->pluck('codigo')->unique()->toArray();
            $response = MasterCombos::whereIn('parent_id', function ($query) {
                $query->select('id')
                    ->from('master_combos')
                    ->where('code', 'tipo_documento');
            })
                ->where([
                    ['status', '=', true],
                ])
                ->whereIn('valor1', $monedas)
                ->orderBy('orden', 'asc')
                ->get();
            return $response;
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
