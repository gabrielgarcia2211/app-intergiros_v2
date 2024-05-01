<?php

namespace App\Http\Requests\Solicitudes;

use App\Models\Administracion\TipoFormulario;
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
        $rules =  [
            'depositante_id' => 'required',
            'beneficiario_id' => 'required',
            'tipo_formulario_id' => 'required',
            'tipo_moneda_id' => 'required',
            'monto_a_pagar' => 'required',
            'monto_a_recibir' => 'required',
        ];

        $tipo_formulario = TipoFormulario::where('id', request('tipo_formulario_id'))->first();
        if(in_array($tipo_formulario->codigo, ['TP-02', 'TP-03'])){
            $rules = $rules + ['referencia_pago' => 'required|max:' . env('UPLOAD_MAX_FILESIZE')];
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
            'depositante_id.required' => 'El campo depositante es obligatorio.',
            'beneficiario_id.required' => 'El campo beneficiario es obligatorio.',
            'tipo_formulario_id.required' => 'El campo tipo formulario es obligatorio.',
            'tipo_moneda_id.required' => 'El campo tipo moneda es obligatorio.',
            'monto_a_pagar.required' => 'El campo monto a pagar es obligatorio.',
            'monto_a_recibir.required' => 'El campo monto a recibir es obligatorio.',
            'referencia_pago.required' => 'La foto de referencia de pago es obligatoria.',
            'referencia_pago.max' => 'El tamaño del archivo debe ser menor a ' . env('UPLOAD_MAX_FILESIZE') / 1024 . ' MB',
        ];
    }

    public function attributes(): array
    {
        return [
            'depositante_id' => 'depositante',
            'beneficiario_id' => 'beneficiario',
            'tipo_formulario_id' => 'tipo formulario',
            'tipo_moneda_id' => 'tipo moneda',
            'referencia_pago' => 'referencia de pago',
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
