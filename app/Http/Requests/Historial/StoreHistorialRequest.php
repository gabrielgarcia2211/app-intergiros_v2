<?php

namespace App\Http\Requests\Historial;

use App\Models\Configuration\MasterCombos;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHistorialRequest extends FormRequest
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

        $opciones = request('opcion');
        $field_update = request('field_update');

        $rules = [
            'solicitud_id' => 'required',
            'comentario' => 'nullable|max:200',
        ];

        if ($field_update != 'monto') {
            $rules['opcion'] = 'required';
        }

        $masterCombos = MasterCombos::where('id', $opciones)->get();

        $tieneReintentarBeneficiarioPs = $masterCombos->contains(function ($value, $key) {
            return $value->code == 'reintentar_beneficiario_pr' || $value->code == 'reintentar_pr';
        });
        if ($tieneReintentarBeneficiarioPs) {
            $rules['tercero_id'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'solicitud_id.required' => 'El campo solicitud es obligatorio.',
            'afiliado_id.required' => 'El campo afiliado es obligatorio.',
            'tercero_id.required' => 'El campo beneficiario/depositante es obligatorio.',
        ];
    }

    public function attributes(): array
    {
        return [
            'solicitud_id' => 'solicitud',
            'afiliado_id' => 'afiliado',
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
