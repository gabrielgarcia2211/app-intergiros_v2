<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Solicitudes\Solicitudes;
use Illuminate\Support\Facades\Storage;
use Spatie\Ignition\Contracts\Solution;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\TipoFormulario;
use App\Http\Controllers\ResponseController as Response;

class AdministracionController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function tasas()
    {
        return view('admin.tasas');
    }

    public function verificar()
    {
        return view('admin.verificacion');
    }

    public function envios()
    {
        return view('admin.envios');
    }

    public function noticias()
    {
        return view('admin.noticias');
    }

    public function getSolicitudes(Request $request)
    {
        try {
            $query = $this->setQuery();
            return renderDataTable(
                $query,
                $request,
                [],
                [
                    'solicitudes.id',
                    'users.name as user',
                    'users.apellidos as apellidos_user',
                    'users.email as email_user',
                    'users.documento as documento_user',
                    'users.telefono as telefono_user',
                    'users.path_selfie as path_selfie_user',
                    'users.path_documento as path_documento_user',
                    'users.verificado',
                    'solicitudes.monto_a_pagar',
                    'solicitudes.monto_a_recibir',
                    'solicitudes.revisiones',
                    'solicitudes.imagen_comprobante',
                    'solicitudes.voucher_referencia',
                    'tipo_formulario.descripcion as tipo_formulario',
                    'tipo_moneda.tipo as tipo_moneda',
                    'tipo_moneda.descripcion as descripcion_moneda',
                    'ter_d.nombre as nombre_depositante',
                    'ter_d.documento as documento_depositante',
                    'ter_d.banco as banco_depositante',
                    'ter_d.cuenta as cuenta_depositante',
                    'ter_d.pago_movil as pago_movil_depositante',
                    'ter_d.correo as correo_depositante',
                    'ter_d.celular as celular_depositante',
                    'ter_d.path_documento as path_documento_depositante',
                    'ter_b.nombre as nombre_beneficiario',
                    'ter_b.documento as documento_beneficiario',
                    'ter_b.banco as banco_beneficiario',
                    'ter_b.cuenta as cuenta_beneficiario',
                    'ter_b.pago_movil as pago_movil_beneficiario',
                    'ter_b.correo as correo_beneficiario',
                    'ter_b.celular as celular_beneficiario',
                    'ter_b.path_documento as path_documento_beneficiario',
                    'productos.nombre as nombre_producto',
                    'productos.costo_base as costo_base_producto',
                    'productos.rango_min as rango_min_producto',
                    'productos.rango_max as rango_max_producto',
                    'mc_estado.name as estado_actual',
                    'mc_estado.id as estado_actual_id',
                ]
            );
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return Response::sendError("Ocurrio un error inesperado al intentar procesar la solicitud", 500);
        }
    }

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

    private function setQuery()
    {
        return Solicitudes::query()
            ->leftJoin('tipo_formulario', 'tipo_formulario.id', '=', 'solicitudes.tipo_formulario_id')
            ->leftJoin('tipo_moneda', 'tipo_moneda.id', '=', 'solicitudes.tipo_moneda_id')
            ->leftJoin('terceros as ter_b', 'ter_b.id', '=', 'solicitudes.beneficiario_id')
            ->leftJoin('terceros as ter_d', 'ter_d.id', '=', 'solicitudes.depositante_id')
            ->leftJoin('productos', 'productos.id', '=', 'solicitudes.producto_id')
            ->leftJoin('users', 'users.id', '=', 'solicitudes.user_id')
            ->leftJoin('master_combos as mc_estado', 'mc_estado.id', '=', 'solicitudes.estado_id');
    }

    public function getPathReal(Request $request)
    {
        $disk = 'comprobante_disk';
        $path = $request->input('path');

        if (empty($path) || !Storage::disk($disk)->exists($path)) {
            return asset('img/no-image.png');
        }

        return Storage::disk($disk)->url($path);
    }

    public function createOrUpdateVoucher(Request $request)
    {
        try {
            $path = $request->all()['path'];
            $action = $request->all()['action'];
            $solicitud_id = $request->all()['solicitud_id'];
            $solicitud = Solicitudes::find($solicitud_id);
            if ($action == 'CREATE') {
                $solicitud->voucher_referencia =  $this->fileService->saveFile($path, $solicitud->user_id, 'voucher_solicitud');
            } else if ($action == 'DELETE') {
                $this->fileService->deleteFile($solicitud->voucher_referencia);
                $solicitud->voucher_referencia = null;
            }
            $solicitud->save();
            return Response::sendResponse($solicitud, 'Registro actualizado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }
}
