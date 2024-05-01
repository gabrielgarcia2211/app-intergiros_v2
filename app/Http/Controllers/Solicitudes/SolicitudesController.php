<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;
use App\Services\FileService;
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

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function indexPago()
    {
        return view('envio.pagopaypal');
    }

    public function create(StoreSolicitudRequest $request)
    {
        try {

            if (Auth::user()->verificado != 1) {
                return Response::sendError('El usuario no se encuentra verificado', 400);
            }

            $depositante_id = $request->input('depositante_id');
            $beneficiario_id = $request->input('beneficiario_id');
            $tipo_formulario_id = $request->input('tipo_formulario_id');
            $tipo_moneda_id = $request->input('tipo_moneda_id');
            $monto_a_pagar = $request->input('monto_a_pagar');
            $monto_a_recibir = $request->input('monto_a_recibir');
            $referencia_pago = $request->file('referencia_pago');

            $estado_iniciado_id = MasterCombos::getEstadoSolicitud('iniciado');
            $estado_en_proceso_id = MasterCombos::getEstadoSolicitud('en_proceso');

            $producto = getCostRange($monto_a_pagar);
            if (empty($producto)) {
                return Response::sendError('No se encontro un producto en este rango de costo', 400);
            }

            $solicitud = new Solicitudes;
            $solicitud->tipo_formulario_id = $tipo_formulario_id;
            $solicitud->tipo_moneda_id = $tipo_moneda_id;
            $solicitud->depositante_id = $depositante_id;
            $solicitud->beneficiario_id = $beneficiario_id;
            $solicitud->monto_a_pagar = $monto_a_pagar;
            $solicitud->monto_a_recibir = $monto_a_recibir;
            $solicitud->user_id = Auth()->user()->id;
            $solicitud->estado_id = ($tipo_formulario_id == 1) ? $estado_iniciado_id : $estado_en_proceso_id;
            $solicitud->producto_id = $producto['id'];
            $solicitud->revisiones = $producto['revisiones'];
            if (isset($referencia_pago)) {
                $solicitud->voucher_referencia_cliente = $this->fileService->saveFile($referencia_pago, Auth()->user()->id, 'voucher_referencia_cliente');
            }
            $solicitud->save();

            return Response::sendResponse($solicitud, 'Registro creado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex);
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
            ])->with(Solicitudes::RELATIONS)->first();
            return Response::sendResponse($solicitud, 'Registro obtenido con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getUpdateEstado($id, Request $request)
    {
        return Solicitudes::where('id', $id)->update([
            'estado_id' => $request->input('estado_id')
        ]);
    }
}
