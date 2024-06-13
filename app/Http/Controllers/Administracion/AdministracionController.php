<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\Noticias\Noticia;
use Illuminate\Support\Facades\DB;
use App\Models\Historial\Historial;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Noticias\UserNoticia;
use App\Models\Solicitudes\Solicitudes;
use Illuminate\Support\Facades\Storage;
use Spatie\Ignition\Contracts\Solution;
use App\Models\Administracion\TasaCambio;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\TipoFormulario;
use App\Http\Requests\Perfil\UpdateUserRequest;
use App\Http\Requests\Noticias\CreateNoticiaRequest;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\Administracion\UpdateTasaCambioRequest;

class AdministracionController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function tasas()
    {
        return view('admin.tasas');
    }

    public function envios()
    {
        return view('admin.envios');
    }

    public function verificar()
    {
        return view('admin.verificacion');
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
                    'solicitudes.uuid as uuid',
                    'users.path_documento as path_documento_user',
                    'users.verificado',
                    'solicitudes.monto_a_pagar',
                    'solicitudes.monto_a_pagar_comision',
                    'solicitudes.monto_a_recibir',
                    'solicitudes.revisiones',
                    'solicitudes.voucher_referencia',
                    'solicitudes.voucher_referencia_cliente',
                    'tipo_formulario.descripcion as tipo_formulario',
                    'tipo_moneda.tipo as tipo_moneda',
                    'tipo_moneda.descripcion as descripcion_moneda',
                    'ter_d.nombre as nombre_depositante',
                    'ter_d.documento as documento_depositante',
                    'mc_banco_d.name as banco_depositante',
                    'ter_d.cuenta as cuenta_depositante',
                    'ter_d.pago_movil as pago_movil_depositante',
                    'ter_d.correo as correo_depositante',
                    'ter_d.celular as celular_depositante',
                    'ter_d.path_documento as path_documento_depositante',
                    'ter_b.nombre as nombre_beneficiario',
                    'ter_b.documento as documento_beneficiario',
                    'mc_banco_b.name as banco_beneficiario',
                    'mc_tipo_banco.name as tipo_cuenta',
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
                    DB::raw('CONCAT(historial.solicitud_id) AS historial_id')
                ]
            );
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
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
        $monedas = TipoMoneda::get([
            'id',
            'tipo',
        ]);
        foreach ($monedas as $key => $value) {
            switch ($value->tipo) {
                case 'Bolivar':
                    $monedas[$key]->descripcion = $value->tipo . ', ' . 'Venezuela';
                    break;
                case 'Sol':
                case 'Dolar':
                    $monedas[$key]->descripcion =  $value->tipo . ', ' . 'Perú';
                    break;
                case 'Peso':
                    $monedas[$key]->descripcion =  $value->tipo . ', ' . 'Colombia';
                    break;
                default:
                    break;
            }
        }
        return $monedas;
    }

    public function getMonedaByCodigo($codigo)
    {
        $monedas = TipoMoneda::whereIn('codigo', explode(",", $codigo))
            ->get([
                'id',
                'tipo'
            ]);
        foreach ($monedas as $key => $value) {
            switch ($value->tipo) {
                case 'Bolivar':
                    $monedas[$key]->descripcion = $value->tipo . ', ' . 'Venezuela';
                    break;
                case 'Sol':
                case 'Dolar':
                    $monedas[$key]->descripcion =  $value->tipo . ', ' . 'Perú';
                    break;
                case 'Peso':
                    $monedas[$key]->descripcion =  $value->tipo . ', ' . 'Colombia';
                    break;
                default:
                    break;
            }
        }
        return $monedas;
    }

    private function setQuery()
    {
        return Solicitudes::query()
            ->distinct()
            ->leftJoin('tipo_formulario', 'tipo_formulario.id', '=', 'solicitudes.tipo_formulario_id')
            ->leftJoin('tipo_moneda', 'tipo_moneda.id', '=', 'solicitudes.tipo_moneda_id')
            ->leftJoin('terceros as ter_b', 'ter_b.id', '=', 'solicitudes.beneficiario_id')
            ->leftJoin('terceros as ter_d', 'ter_d.id', '=', 'solicitudes.depositante_id')
            ->leftJoin('productos', 'productos.id', '=', 'solicitudes.producto_id')
            ->leftJoin('users', 'users.id', '=', 'solicitudes.user_id')
            ->leftJoin('master_combos as mc_estado', 'mc_estado.id', '=', 'solicitudes.estado_id')
            ->leftJoin('master_combos as mc_banco_b', 'mc_banco_b.id', '=', 'ter_b.banco_id')
            ->leftJoin('master_combos as mc_banco_d', 'mc_banco_d.id', '=', 'ter_d.banco_id')
            ->leftJoin('master_combos as mc_tipo_banco', 'mc_tipo_banco.id', '=', 'ter_b.tipo_cuenta_id')
            ->leftJoin('historial', 'historial.solicitud_id', '=', 'solicitudes.id');
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

    public function getTasaCambio()
    {
        $tipo_formulario = TipoFormulario::select([
            'tipo_formulario.id as tipo_formulario_id',
            'tipo_formulario.descripcion',
            'tipo_formulario.codigo',
            'tasa_cambio.id as tasa_cambio_id',
            'tasa_cambio.valor',
        ])
            ->join('tasa_cambio', 'tasa_cambio.tipo_formulario_id', 'tipo_formulario.id')
            ->distinct()
            ->get();

        return $tipo_formulario;
    }

    public function updateTasaCambio(UpdateTasaCambioRequest $request)
    {
        try {
            $tasa = TasaCambio::find($request->input('tasa_id'));
            $tasa->valor = $request->input('new_value');
            $tasa->save();
            return Response::sendResponse($tasa, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function getUsersVerificados(Request $request)
    {
        try {
            $query = $this->setQueryUsersVerificados();
            return renderDataTable(
                $query,
                $request,
                [],
                [
                    'users.id',
                    'users.name as user',
                    'users.apellidos as apellidos_user',
                    'users.email as email_user',
                    'users.documento as documento_user',
                    'users.telefono as telefono_user',
                    'users.path_selfie as path_selfie_user',
                    'users.path_documento as path_documento_user',
                    'users.verificado',
                ]
            );
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    private function setQueryUsersVerificados()
    {
        return User::query();
    }

    public function updateUserVerificado(User $User, Request $request)
    {
        return $User->update([
            'verificado' => $request->input('estado_id')
        ]);
    }

    public function createNoticia(CreateNoticiaRequest $request)
    {
        try {
            $noticia = new Noticia();
            $noticia->titulo = $request->input('titulo');
            $noticia->referencia = $request->input('referencia');
            $noticia->descripcion = $request->input('descripcion');
            $noticia->save();
            self::upUserNoticias($noticia);
            return Response::sendResponse($noticia, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    private static function upUserNoticias($noticia)
    {
        $listUsers = User::all()->pluck('id')->toArray();
        $registros = [];
        foreach ($listUsers as $userId) {
            $registros[] = [
                'user_id' => $userId,
                'noticia_id' => $noticia->id,
                'visible' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        UserNoticia::insert($registros);
    }

    public function getHistorial($solicitud_id)
    {
        $response = Historial::where('solicitud_id', $solicitud_id)->get();
        $opciones = $response->pluck('opciones');
        return $opciones->toArray();
    }
}
