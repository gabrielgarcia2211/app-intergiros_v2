<?php

namespace App\Http\Requests\Administracion;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTasaCambioRequest extends FormRequest
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
            'tasa_id' => 'required',
            'new_value' => 'required',
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
            'tasa_id.required' => 'La tasa es obligatorio.',
            'new_value.required' => 'El nuevo valor es obligatorio.',
        ];
    }

    public function attributes(): array
    {
        return [
            'tasa_id' => 'depositante',
            'new_value' => 'nuevo valor',
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
