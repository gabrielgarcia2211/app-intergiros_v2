<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Solicitudes\Producto;
use Illuminate\Support\Facades\Auth;
use App\Models\Depositante\Depositante;
use App\Models\Solicitudes\Solicitudes;
use Spatie\Ignition\Contracts\Solution;
use App\Models\Configuration\MasterCombos;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\Solicitudes\StoreSolicitudRequest;

class SolicitudesController extends Controller
{

    public function indexPago()
    {
        return view('envio.pagopaypal');
    }

    public function initSolicitud(StoreSolicitudRequest $request)
    {
        try {
            $depositante_id = $request->input('depositante_id');
            $beneficiario_id = $request->input('beneficiario_id');
            $tipo_formulario_id = $request->input('tipo_formulario_id');
            $tipo_moneda_id = $request->input('tipo_moneda_id');
            $monto_a_pagar = $request->input('monto_a_pagar');
            $monto_a_recibir = $request->input('monto_a_recibir');

            $estado_id = MasterCombos::getEstadoSolicitud('iniciado');

            $producto = getCostRange($monto_a_pagar);
            if (empty($producto)) {
                return Response::sendError('No se encontro un producto en este rango de costo', 422);
            }
            $solicitud = Solicitudes::create([
                'tipo_formulario_id' => $tipo_formulario_id,
                'tipo_moneda_id' => $tipo_moneda_id,
                'depositante_id' => $depositante_id,
                'beneficiario_id' => $beneficiario_id,
                'monto_a_pagar' => $monto_a_pagar,
                'monto_a_recibir' => $monto_a_recibir,
                'user_id' => Auth()->user()->id,
                'estado_id' => $estado_id,
                'producto_id' => $producto['id'],
                'revisiones' => $producto['revisiones'],
            ]);

            return Response::sendResponse($solicitud, 'Registro creado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getSolicitud($id)
    {
        try {
            $solicitud = Solicitudes::where([
                'id' => $id,
                'user_id' => Auth()->user()->id,
            ])->with(Solicitudes::RELATIONS)->get()->first();
            return Response::sendResponse($solicitud, 'Registro obtenido con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
