<?php

namespace App\Http\Controllers\Depositante;

use App\Services\FileService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Depositante\Depositante;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\Depositante\StoreDepositanteRequest;
use App\Http\Requests\Depositante\UpdateDepositanteRequest;

class DepositanteController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('');
    }

    public function getDepositantes()
    {
        return Depositante::where(['user_id' => Auth()->user()->id])->get();
    }

    public function show($id)
    {
        return Depositante::find($id);
    }

    public function store(StoreDepositanteRequest $request)
    {
        try {

            $alias = $request->input("paypalAliasDepositante");
            $nombre = $request->input("paypalNombreDepositante");
            $tipoDocumento = $request->input("paypalTipoDocumentoDepositante");
            $documento = $request->input("paypalDocumentoDepositante");
            $correo = $request->input("paypalCorreoDepositante");
            $ind_celular = $request->input("paypalIndicativoDepositante");
            $celular = $request->input("paypalCelularDepositante");
            $pais = $request->input("paypalPaisDepositante");
            $pais = $request->input("paypalPaisDepositante");

            $path_documento = $this->fileService->saveFile($request->file("adjuntarDocumento"));

            $data = Depositante::create([
                'alias' => $alias,
                'nombre' => $nombre,
                'tipo_documento_id' => $tipoDocumento,
                'documento' => $documento,
                'correo' => $correo,
                'pais_telefono_id' => $ind_celular,
                'celular' => $celular,
                'pais_id' => $pais,
                'path_documento' => $path_documento,
                'user_id' => Auth()->user()->id,
            ]);

            return Response::sendResponse($data, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function update(UpdateDepositanteRequest $request, Depositante $Depositante)
    {
        try {

            $alias = $request->input("paypalAliasDepositante");
            $nombre = $request->input("paypalNombreDepositante");
            $tipoDocumento = $request->input("paypalTipoDocumentoDepositante");
            $documento = $request->input("paypalDocumentoDepositante");
            $banco = $request->input("paypalBancoDepositante");
            $cuenta = $request->input("paypalCuentaDepositante");
            $pagoMoovil = $request->input("paypalPagoMovilDepositante");

            $data = $Depositante->update([
                'alias' => $alias,
                'nombre' => $nombre,
                'tipo_documento_id' => $tipoDocumento,
                'documento' => $documento,
                'banco' => $banco,
                'cuenta' => $cuenta,
                'cuenta' => $cuenta,
                'pago_movil' => $pagoMoovil,
            ]);
            return Response::sendResponse($data, 'Registro actualizado con exito.');
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function destroy(Depositante $Depositante)
    {
        return Response::sendResponse($Depositante->delete(), "Recurso eliminado con exito");
    }
}
