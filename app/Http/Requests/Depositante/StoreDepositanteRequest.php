<?php

namespace App\Http\Requests\Depositante;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDepositanteRequest extends FormRequest
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
            'paypalAliasDepositante' => 'required',
            'paypalNombreDepositante' => 'required',
            'paypalTipoDocumentoDepositante' => 'required',
            'paypalDocumentoDepositante' => 'required',
            'paypalCorreoDepositante' => 'required',
            'paypalIndicativoDepositante' => 'required',
            'paypalCelularDepositante' => 'required',
            'paypalPaisDepositante' => 'required',
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
            'paypalAliasDepositante.required' => 'El campo alias es obligatorio.',
            'paypalNombreDepositante.required' => 'El campo nombre es obligatorio.',
            'paypalTipoDocumentoDepositante.required' => 'El campo tipo documento es obligatorio.',
            'paypalDocumentoDepositante.required' => 'El campo documento es obligatorio.',
            'paypalCorreoDepositante' => 'El campo correo  es obligatorio.',
            'paypalIndicativoDepositante' => 'El campo indicativo celular  es obligatorio.',
            'paypalCelularDepositante' => 'El campo celular  es obligatorio.',
            'paypalPaisDepositante' => 'El campo pais es obligatorio.',
        ];
    }

    public function attributes(): array
    {
        return [
            'paypalAliasDepositante' => 'alias',
            'paypalNombreDepositante' => 'nombre',
            'paypalTipoDocumentoDepositante' => 'tipo documento',
            'paypalDocumentoDepositante' => 'documento',
            'paypalCorreoDepositante' => 'correo',
            'paypalIndicativoDepositante' => 'indicativo celular',
            'paypalCelularDepositante' => 'celular',
            'paypalPaisDepositante' => 'pais',
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
