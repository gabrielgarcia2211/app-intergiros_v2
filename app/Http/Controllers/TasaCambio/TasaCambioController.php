<?php

namespace App\Http\Controllers\TasaCambio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Administracion\TasaCambio;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\TipoFormulario;
use App\Http\Controllers\ResponseController as Response;

class TasaCambioController extends Controller
{
    public function convertTasa(Request $request)
    {
        try {
            if (empty($request->input('tipo_moneda'))  || (empty($request->input('monto')) || $request->input('monto') == 'null')) {
                return;
            }
            $monto = $request->input('monto');
            $tipo_moneda = $request->input('tipo_moneda');
            $tipo_formulario = $request->input('tipo_formulario');

            $formulario = TipoFormulario::find($tipo_formulario);
            $moneda = TipoMoneda::find($tipo_moneda);
            $codigo_tasa = $formulario->codigo . "-" .  $moneda->codigo;
            $tasa_cambio = TasaCambio::join('tipo_formulario', 'tipo_formulario.id', '=', 'tasa_cambio.tipo_formulario_id')
                ->where([
                    'tipo_formulario.codigo' => $codigo_tasa
                ])->get([
                    'tasa_cambio.valor'
                ])->first();
            switch ($formulario->codigo) {
                case 'TP-01':
                    if (!empty($tasa_cambio)) {
                        $currency_to = self::currencyEquivalenceTo($formulario->codigo);
                        $currency_from = self::currencyEquivalenceFrom($moneda->codigo);
                        $monto_a_pagar = "$ " . number_format($monto, 2, ',', '.') . " " . $currency_to;
                        $monto_a_recibir = "$ " . number_format(($tasa_cambio->valor * $monto), 2, ',', '.') . " " . $currency_from;
                        $comision_fija = 0.3;
                        $comision = round((($monto + $comision_fija) * 100) / 94.6, 2);
                        if (!empty($currency_to) && !empty($currency_from)) {
                            return Response::sendResponse(['pagar' => $monto_a_pagar, 'pagar_con_comision' => $comision ?? NULL, 'recibir' => $monto_a_recibir]);
                        }
                    }
                    break;
                case 'TP-02':
                case 'TP-03':
                case 'TP-04':
                    if (!empty($tasa_cambio)) {
                        $currency_to = self::currencyEquivalenceTo($formulario->codigo);
                        $currency_from = self::currencyEquivalenceFrom($moneda->codigo);
                        $monto_a_pagar = "$ " . number_format($monto, 2, ',', '.') . " " . $currency_to;
                        $monto_a_recibir = "$ " . number_format(($tasa_cambio->valor * $monto), 2, ',', '.') . " " . $currency_from;
                        if (!empty($currency_to) && !empty($currency_from)) {
                            return Response::sendResponse(['pagar' => $monto_a_pagar, 'recibir' => $monto_a_recibir]);
                        }
                    }
                    break;

                default:
                    break;
            }

            return Response::sendResponse(false, 'No hay informacion');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function operationsCalc(Request $request)
    {
        try {
            if (empty($request->input('codigo_formulario'))  || (empty($request->input('codigo_moneda')) || $request->input('monto') == 'null')) {
                return;
            }
            $codigo_tasa = $request->input('codigo_tasa');
            $codigo_formulario = $request->input('codigo_formulario');
            $codigo_moneda = $request->input('codigo_moneda');
            $monto = $request->input('monto');
            $tasa_cambio = TasaCambio::join('tipo_formulario', 'tipo_formulario.id', '=', 'tasa_cambio.tipo_formulario_id')
                ->where([
                    'tipo_formulario.codigo' => $codigo_tasa
                ])->get([
                    'tasa_cambio.valor'
                ])->first();

            $currency_to = self::currencyEquivalenceTo($codigo_formulario);
            $currency_from = self::currencyEquivalenceFrom($codigo_moneda);

            switch ($codigo_formulario) {
                case 'TP-01':
                    if (!empty($tasa_cambio)) {
                        $monto_a_recibir = number_format(($tasa_cambio->valor * $monto), 2, ',', '.');
                        $tasa_cambio->valor = "$ " . number_format($tasa_cambio->valor, 2, ',', '.') . " " . $currency_from;
                        $comision_fija = 0.3;
                        $comision = "$ " . round((($monto + $comision_fija) * 100) / 94.6 - $monto, 2) . " " . $currency_to;
                        $monto_a_pagar = "$ " . round((($monto + $comision_fija) * 100) / 94.6, 2) . " " . $currency_to;
                        return Response::sendResponse(['pagar' => $monto_a_pagar, 'pagar_con_comision' => $comision, 'recibir' => $monto_a_recibir, 'tasa' => $tasa_cambio]);
                    }
                    break;
                case 'TP-02':
                case 'TP-03':
                    if (!empty($tasa_cambio)) {
                        $monto_a_pagar = "$ " . number_format($monto, 2, ',', '.') . " " . $currency_to;
                        $monto_a_recibir = number_format(($tasa_cambio->valor * $monto), 2, ',', '.');
                        $tasa_cambio->valor = "$ " . number_format($tasa_cambio->valor, 2, ',', '.') . " " . $currency_from;
                        return Response::sendResponse(['pagar' => $monto_a_pagar, 'pagar_con_comision' => "0.00", 'recibir' => $monto_a_recibir, 'tasa' => $tasa_cambio]);
                    }
                    break;
                default:
                    break;
            }

            return Response::sendResponse(false, 'No hay informacion');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getTasaCambio()
    {
        try {
            $data = TasaCambio::leftJoin('tipo_formulario', 'tipo_formulario.id', '=', 'tasa_cambio.tipo_formulario_id')
                ->whereIn('tipo_formulario.codigo', ['TP-01', 'TP-02', 'TP-03', 'TP-04', 'TP-05', 'TP-06', 'TP-07', 'TP-08'])
                ->get();
            return Response::sendResponse($data, 'Registros obtenidos con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getLine());
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    private static function currencyEquivalenceTo($codigo)
    {
        $currency = null;
        switch ($codigo) {
            case 'TP-01':
                $currency = 'dólar';
                break;
            case 'TP-02':
                $currency = 'dólar';
                break;
            case 'TP-03':
                $currency = 'dólar';
                break;
            case 'TP-04':
                $currency = 'soles';
                break;
            default:
                break;
        }

        return $currency;
    }

    private static function currencyEquivalenceFrom($codigo)
    {
        $currency = null;
        switch ($codigo) {
            case 'VES':
                $currency = 'bs';
                break;
            case 'PEN':
                $currency = 'soles';
                break;
            case 'USD':
                $currency = 'dólar';
                break;
            case 'COP':
                $currency = 'cop';
                break;
            default:
                break;
        }

        return $currency;
    }
}
