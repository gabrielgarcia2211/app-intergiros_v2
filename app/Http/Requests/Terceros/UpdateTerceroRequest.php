<?php

namespace App\Http\Requests\Terceros;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTerceroRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch (request('code')) {
            case 'TB':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasBeneficiario' => 'required',
                            'nombreBeneficiario' => 'required',
                            'tipoDocumentoBeneficiario' => 'required',
                            'documentoBeneficiario' => 'required|integer',
                            'bancoBeneficiario' => 'required',
                            'cuentaBeneficiario' => 'required',
                            'pagoMovilBeneficiario' => 'required',
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasBeneficiario' => 'required',
                            'usdtNombreBeneficiario' => 'required',
                            'usdtTipoDocBeneficiario' => 'required',
                            'usdtTipoCuentaBeneficiario' => 'required',
                            'usdtDocBeneficiario' => 'required|integer',
                            'usdtBancoBeneficiario' => 'required',
                            'usdtCuentaBeneficiario' => 'required',
                            'usdtMovilBeneficiario' => 'required',
                        ];
                        break;
                }
            case 'TD':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasDepositante' => 'required',
                            'nombreDepositante' => 'required',
                            'tipoDocumentoDepositante' => 'required',
                            'documentoDepositante' => 'required|integer',
                            'correoDepositante' => 'required',
                            'codigoIDepositante' => 'required',
                            'celularDepositante' => 'required',
                            'paisDepositante' => 'required',
                            //'adjuntarDocumento' => 'required|file|max:' . env('UPLOAD_MAX_FILESIZE'),
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasDepositante' => 'required',
                            'usdtNombreDepositante' => 'required',
                            'usdtTipoDocDepositante' => 'required',
                            'usdtDocDepositante' => 'required|integer',
                            'usdtEmailDepositante' => 'required',
                            'usdtIndicativoDepositante' => 'required',
                            'usdtCelularDepositante' => 'required',
                            'usdtPaisDepositante' => 'required',
                            'adjuntarDocumentoUsdt' => 'required|file|max:' . env('UPLOAD_MAX_FILESIZE'),
                        ];
                        break;
                }
            default:
                break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        switch (request('code')) {
            case 'TB':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasBeneficiario.required' => 'El campo alias es obligatorio.',
                            'nombreBeneficiario.required' => 'El campo nombre es obligatorio.',
                            'tipoDocumentoBeneficiario.required' => 'El campo tipo documento es obligatorio.',
                            'documentoBeneficiario.required' => 'El campo documento es obligatorio.',
                            'bancoBeneficiario.required' => 'El campo banco es obligatorio.',
                            'cuentaBeneficiario.required' => 'El campo cuenta es obligatorio.',
                            'pagoMovilBeneficiario.required' => 'El campo pago movil es obligatorio.'
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasBeneficiario.required' => 'El campo alias es obligatorio.',
                            'usdtNombreBeneficiario.required' => 'El campo nombre es obligatorio.',
                            'usdtTipoDocBeneficiario.required' => 'El campo tipo documento es obligatorio.',
                            'usdtTipoCuentaBeneficiario.required' => 'El campo tipo cuenta es obligatorio.',
                            'usdtDocBeneficiario.required' => 'El campo documento es obligatorio.',
                            'usdtBancoBeneficiario.required' => 'El campo banco es obligatorio.',
                            'usdtCuentaBeneficiario.required' => 'El campo cuenta es obligatorio.',
                            'usdtMovilBeneficiario.required' => 'El campo pago movil es obligatorio.',
                        ];
                        break;
                }
            case 'TD':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasDepositante.required' => 'El campo alias es obligatorio.',
                            'nombreDepositante.required' => 'El campo nombre es obligatorio.',
                            'tipoDocumentoDepositante.required' => 'El campo tipo documento es obligatorio.',
                            'documentoDepositante.required' => 'El campo documento es obligatorio.',
                            'correoDepositante.required' => 'El campo correo  es obligatorio.',
                            'codigoIDepositante.required' => 'El campo indicativo celular es obligatorio.',
                            'celularDepositante.required' => 'El campo celular  es obligatorio.',
                            'paisDepositante.required' => 'El campo pais es obligatorio.',
                            //'adjuntarDocumento.required' => 'La foto del documento es obligatoria.',
                            //'adjuntarDocumento.max' => 'El tamaño del archivo debe ser menor a ' . env('UPLOAD_MAX_FILESIZE') / 1024 . ' MB',
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasDepositante.required' => 'El campo alias es obligatorio.',
                            'usdtNombreDepositante.required' => 'El campo nombre es obligatorio.',
                            'usdtTipoDocDepositante.required' => 'El campo tipo documento es obligatorio.',
                            'usdtDocDepositante.required' => 'El campo documento es obligatorio.',
                            'usdtEmailDepositante.required' => 'El campo correo es obligatorio.',
                            'usdtIndicativoDepositante.required' => 'El campo indicativo celular es obligatorio.',
                            'usdtCelularDepositante.required' => 'El campo celular es obligatorio.',
                            'usdtPaisDepositante.required' => 'El campo pais es obligatorio.',
                            'adjuntarDocumentoUsdt.max' => 'El tamaño del archivo debe ser menor a ' . env('UPLOAD_MAX_FILESIZE') / 1024 . ' MB',
                        ];
                        break;
                }

            default:
                break;
        }
    }

    public function attributes(): array
    {
        switch (request('code')) {
            case 'TB':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasBeneficiario' => 'alias',
                            'nombreBeneficiario' => 'nombre',
                            'tipoDocumentoBeneficiario' => 'tipo documento',
                            'documentoBeneficiario' => 'documento',
                            'bancoBeneficiario' => 'banco',
                            'cuentaBeneficiario' => 'cuenta',
                            'pagoMovilBeneficiario' => 'pago movil'
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasBeneficiario' => 'alias',
                            'usdtNombreBeneficiario' => 'nombre',
                            'usdtTipoDocBeneficiario' => 'tipo documento',
                            'usdtDocBeneficiario' => 'documento',
                            'usdtBancoBeneficiario' => 'banco',
                            'usdtCuentaBeneficiario' => 'cuenta',
                            'usdtMovilBeneficiario' => 'pago movil'
                        ];
                        break;
                }
            case 'TD':
                switch (request('servicio')) {
                    case 'TP-01':
                        return [
                            'aliasDepositante' => 'alias',
                            'nombreDepositante' => 'nombre',
                            'tipoDocumentoDepositante' => 'tipo documento',
                            'documentoDepositante' => 'documento',
                            'correoDepositante' => 'correo',
                            'codigoIDepositante' => 'indicativo celular',
                            'celularDepositante' => 'celular',
                            'paisDepositante' => 'pais',
                            //'adjuntarDocumento' => 'foto documento',
                        ];
                        break;
                    case 'TP-02':
                        return [
                            'usdtAliasDepositante' => 'alias',
                            'usdtNombreDepositante' => 'nombre',
                            'usdtTipoDocDepositante' => 'tipo documento',
                            'usdtDocDepositante' => 'documento',
                            'usdtEmailDepositante' => 'correo',
                            'usdtIndicativoDepositante' => 'indicativo celular',
                            'usdtCelularDepositante' => 'celular',
                            'usdtPaisDepositante' => 'pais',
                            'adjuntarDocumentoUsdt' => 'foto documento',
                        ];
                        break;
                }
            default:
                break;
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(array(
            "success" => false,
            "errors" => $validator->errors()
        ), 422));
    }
}
