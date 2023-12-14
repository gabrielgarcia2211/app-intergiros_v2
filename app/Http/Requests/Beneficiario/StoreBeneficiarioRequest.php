<?php

namespace App\Http\Requests\Beneficiario;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBeneficiarioRequest extends FormRequest
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
        return [
            'paypalAliasBeneficiario' => 'required',
            'paypalNombreBeneficiario' => 'required',
            'paypalTipoDocumentoBeneficiario' => 'required',
            'paypalDocumentoBeneficiario' => 'required',
            'paypalBancoBeneficiario' => 'required',
            'paypalCuentaBeneficiario' => 'required',
            'paypalPagoMovilBeneficiario' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'paypalAliasBeneficiario.required' => 'El campo alias es obligatorio.',
            'paypalNombreBeneficiario.required' => 'El campo nombre es obligatorio.',
            'paypalTipoDocumentoBeneficiario.required' => 'El campo tipo documento es obligatorio.',
            'paypalDocumentoBeneficiario.required' => 'El campo documento es obligatorio.',
            'paypalBancoBeneficiario.required' => 'El campo banco es obligatorio.',
            'paypalCuentaBeneficiario.required' => 'El campo cuenta es obligatorio.',
            'paypalPagoMovilBeneficiario.required' => 'El campo pago movil es obligatorio.'
        ];
    }

    public function attributes(): array
    {
        return [
            'paypalAliasBeneficiario' => 'alias',
            'paypalNombreBeneficiario' => 'nombre',
            'paypalTipoDocumentoBeneficiario' => 'tipo documento',
            'paypalDocumentoBeneficiario' => 'documento',
            'paypalBancoBeneficiario' => 'banco',
            'paypalCuentaBeneficiario' => 'cuenta',
            'paypalPagoMovilBeneficiario' => 'pago movil'
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
