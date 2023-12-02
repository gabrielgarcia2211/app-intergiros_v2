<?php

namespace App\Http\Requests\Perfil;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateVerificationRequest extends FormRequest
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
            'formVerificacion' => 'required|array',
            'formVerificacion.documento' => 'required',
            'formVerificacion.tipoDocumento' => 'required',
            'formVerificacion.inputGroupFile01' => 'required',
            'formVerificacion.inputGroupFile02' => 'required',
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
            'formVerificacion.required' => 'Falta informacion en la actualización de verificación.',
            'formVerificacion.documento.required' => 'El campo documento es requerido.',
            'formVerificacion.tipoDocumento.required' => 'El campo tipo de documento es requerido.',
            'formVerificacion.inputGroupFile01.required' => 'El campo selfie es requerido.',
            'formVerificacion.inputGroupFile02.required' => 'El campo foto del documento es requerido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'formActualizarInfo.documento' => 'documento',
            'formActualizarInfo.tipoDocumento' => 'tipo documento',
            'formActualizarInfo.inputGroupFile01' => 'selfie',
            'formActualizarInfo.inputGroupFile02' => 'foto',
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
