<?php

namespace App\Http\Requests\Perfil;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'formActualizarInfo' => 'required|array',
            'formActualizarInfo.pais' => 'required',
            'formActualizarInfo.telefono' => 'required',
            'formActualizarInfo.paisTelefono' => 'required',
            'formActualizarInfo.fehaNacimiento' => 'required',
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
            'formActualizarInfo.required' => 'Falta informacion en la actualización de datos personales.',
            'formActualizarInfo.pais.required' => 'El campo pais es requerido.',
            'formActualizarInfo.telefono.required' => 'El campo telefono es requerido.',
            'formActualizarInfo.paisTelefono.required' => 'El indicativo del pais telefono es requerido.',
            'formActualizarInfo.fehaNacimiento.required' => 'El campo fecha nacimiento es requerido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'formActualizarInfo.pais' => 'pais',
            'formActualizarInfo.telefono' => 'telefono',
            'formActualizarInfo.paisTelefono' => 'inidicativo telefono',
            'formActualizarInfo.fehaNacimiento' => 'fecha nacimiento',
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
