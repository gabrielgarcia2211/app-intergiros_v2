<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegistroRequest extends FormRequest
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
            'formInfoGeneral' => 'required',
            'formInfoPassword' => 'required',
            'formInfoRedes' => 'required',
            'formInfoValidacion' => 'required',
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
            'formInfoGeneral.required' => 'Falta informacion en la validacion de datos personales.',
            'formInfoPassword.required' => 'Falta informacion en la validacion de contraseñas.',
            'formInfoRedes.required' => 'Falta informacion en la validacion de redes.',
            'formInfoValidacion.required' => 'Falta informacion en la validacion de perfil.',
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
