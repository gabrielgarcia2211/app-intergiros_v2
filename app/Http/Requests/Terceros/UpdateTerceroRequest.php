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
                    case 'TP-02':
                    case 'TP-03':
                    case 'TP-04':
                    case 'TP-05':
                        return [
                            'aliasBeneficiario' => 'required',
                            'nombreBeneficiario' => 'required',
                            'tipoDocumentoBeneficiario' => 'required',
                            'documentoBeneficiario' => 'required|integer',
                            'tipoCuentaBeneficiario' => 'required',
                            'bancoBeneficiario' => 'required',
                            'cuentaBeneficiario' => 'required',
                            'pagoMovilBeneficiario' => 'required',
                        ];
                        break;
                }
            case 'TD':
                switch (request('servicio')) {
                    case 'TP-01':
                    case 'TP-02':
                    case 'TP-03':
                        return [
                            'aliasDepositante' => 'required',
                            'nombreDepositante' => 'required',
                            'tipoDocumentoDepositante' => 'required',
                            'documentoDepositante' => 'required|integer',
                            'correoDepositante' => 'required',
                            'codigoIDepositante' => 'required',
                            'celularDepositante' => 'required',
                            'paisDepositante' => 'required',
                            'adjuntarDocumento' => 'required|max:' . env('UPLOAD_MAX_FILESIZE'),
                        ];
                        break;
                    case 'TP-04':
                    case 'TP-05':
                        return [
                            'aliasDepositante' => 'required',
                            'nombreDepositante' => 'required',
                            'tipoDocumentoDepositante' => 'required',
                            'documentoDepositante' => 'required|integer',
                            'bancoDepositante' => 'integer',
                            'codigoIDepositante' => 'required',
                            'celularDepositante' => 'required',
                            'tipoCuentaDepositante' => 'required',
                            'cuentaDepositante' => 'required',
                            'adjuntarDocumento' => 'required|max:' . env('UPLOAD_MAX_FILESIZE'),
                        ];
                        break;
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
        return [
            'aliasBeneficiario.required' => 'El campo alias es obligatorio.',
            'nombreBeneficiario.required' => 'El campo nombre es obligatorio.',
            'tipoDocumentoBeneficiario.required' => 'El campo tipo documento es obligatorio.',
            'documentoBeneficiario.required' => 'El campo documento es obligatorio.',
            'bancoBeneficiario.required' => 'El campo banco es obligatorio.',
            'tipoCuentaBeneficiario' => 'El tipo de cuenta es obligatorio.',
            'cuentaBeneficiario.required' => 'El campo cuenta es obligatorio.',
            'pagoMovilBeneficiario.required' => 'El campo pago movil es obligatorio.',
            'aliasDepositante.required' => 'El campo alias es obligatorio.',
            'nombreDepositante.required' => 'El campo nombre es obligatorio.',
            'tipoDocumentoDepositante.required' => 'El campo tipo documento es obligatorio.',
            'documentoDepositante.required' => 'El campo documento es obligatorio.',
            'correoDepositante.required' => 'El campo correo  es obligatorio.',
            'codigoIDepositante.required' => 'El campo indicativo celular es obligatorio.',
            'celularDepositante.required' => 'El campo celular  es obligatorio.',
            'paisDepositante.required' => 'El campo pais es obligatorio.',
            'adjuntarDocumento.required' => 'La foto del documento es obligatoria.',
            'adjuntarDocumento.max' => 'El tamaño del archivo debe ser menor a ' . env('UPLOAD_MAX_FILESIZE') / 1024 . ' MB',
        ];
    }

    public function attributes(): array
    {
        return [
            'aliasBeneficiario' => 'alias',
            'nombreBeneficiario' => 'nombre',
            'tipoDocumentoBeneficiario' => 'tipo documento',
            'documentoBeneficiario' => 'documento',
            'bancoBeneficiario' => 'banco',
            'tipoCuentaBeneficiario' => 'tipo cuenta',
            'cuentaBeneficiario' => 'cuenta',
            'pagoMovilBeneficiario' => 'pago movil',
            'aliasDepositante' => 'alias',
            'nombreDepositante' => 'nombre',
            'tipoDocumentoDepositante' => 'tipo documento',
            'documentoDepositante' => 'documento',
            'correoDepositante' => 'correo',
            'codigoIDepositante' => 'indicativo celular',
            'celularDepositante' => 'celular',
            'paisDepositante' => 'pais',
            'adjuntarDocumento' => 'foto documento',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(array(
            "success" => false,
            "errors" => $validator->errors()
        ), 422));
    }
}
