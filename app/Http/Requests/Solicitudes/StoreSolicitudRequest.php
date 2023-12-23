<?php

namespace App\Http\Requests\Solicitudes;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSolicitudRequest extends FormRequest
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
            'depositante_id' => 'required',
            'beneficiario_id' => 'required',
            'tipo_formulario_id' => 'required',
            'tipo_moneda_id' => 'required',
            'monto_a_pagar' => 'required',
            'monto_a_recibir' => 'required',
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
            'depositante_id.required' => 'El campo depositante es obligatorio.',
            'beneficiario_id.required' => 'El campo beneficiario es obligatorio.',
            'tipo_formulario_id.required' => 'El campo tipo formulario es obligatorio.',
            'tipo_moneda_id.required' => 'El campo tipo moneda es obligatorio.',
            'monto_a_pagar' => 'El campo monto a pagar es obligatorio.',
            'monto_a_recibir' => 'El campo monto a recibir es obligatorio.',
        ];
    }

    public function attributes(): array
    {
        return [
            'depositante_id' => 'depositante',
            'beneficiario_id' => 'beneficiario',
            'tipo_formulario_id' => 'tipo formulario',
            'tipo_moneda_id' => 'tipo moneda',
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
