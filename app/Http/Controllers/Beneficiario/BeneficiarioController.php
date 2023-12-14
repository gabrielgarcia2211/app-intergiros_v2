<?php

namespace App\Http\Controllers\Beneficiario;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Beneficiario\Beneficiario;
use App\Http\Controllers\ResponseController as Response;
use App\Http\Requests\Beneficiario\StoreBeneficiarioRequest;
use App\Http\Requests\Beneficiario\UpdateBeneficiarioRequest;
use Illuminate\Support\Facades\Auth;

class BeneficiarioController extends Controller
{

    public function index()
    {
        return view('');
    }

    public function getBeneficiarios()
    {
        return Beneficiario::where(['user_id' => Auth()->user()->id])->get();
    }

    public function show($id)
    {
        return Beneficiario::find($id);
    }

    public function store(StoreBeneficiarioRequest $request)
    {
        try {

            $alias = $request->input("paypalAliasBeneficiario");
            $nombre = $request->input("paypalNombreBeneficiario");
            $tipoDocumento = $request->input("paypalTipoDocumentoBeneficiario");
            $documento = $request->input("paypalDocumentoBeneficiario");
            $banco = $request->input("paypalBancoBeneficiario");
            $cuenta = $request->input("paypalCuentaBeneficiario");
            $pagoMoovil = $request->input("paypalPagoMovilBeneficiario");

            $data = Beneficiario::create([
                'alias' => $alias,
                'nombre' => $nombre,
                'tipo_documento_id' => $tipoDocumento,
                'documento' => $documento,
                'banco' => $banco,
                'cuenta' => $cuenta,
                'cuenta' => $cuenta,
                'pago_movil' => $pagoMoovil,
                'user_id' => Auth()->user()->id,
            ]);

            return Response::sendResponse($data, 'Registro guardado con exito.');
        } catch (\Exception $ex) {
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function update(UpdateBeneficiarioRequest $request, Beneficiario $beneficiario)
    {
        try {

            $alias = $request->input("paypalAliasBeneficiario");
            $nombre = $request->input("paypalNombreBeneficiario");
            $tipoDocumento = $request->input("paypalTipoDocumentoBeneficiario");
            $documento = $request->input("paypalDocumentoBeneficiario");
            $banco = $request->input("paypalBancoBeneficiario");
            $cuenta = $request->input("paypalCuentaBeneficiario");
            $pagoMoovil = $request->input("paypalPagoMovilBeneficiario");

            $data = $beneficiario->update([
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

    public function destroy(Beneficiario $beneficiario)
    {
        return Response::sendResponse($beneficiario->delete(), "Recurso eliminado con exito");
    }
}
