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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email',
            'pais' => 'required|string',
            'celular' => 'required|string',
            'tipoCelular' => 'required|string',
            'documento' => 'nullable|string',
            'tipoDocumento' => 'nullable|string',
            'fehaNacimiento' => 'required|date',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
            'red1' => 'nullable|string',
            'nombreRed1' => 'nullable|string',
            'red2' => 'nullable|string',
            'nombreRed2' => 'nullable|string',
            'inputGroupFile01' => 'nullable|file',
            'inputGroupFile02' => 'nullable|file',
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
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser válido.',
            'pais.required' => 'El país es obligatorio.',
            'celular.required' => 'El número de celular es obligatorio.',
            'tipoCelular.required' => 'El tipo de celular es obligatorio.',
            'fehaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fehaNacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'confirmPassword.required' => 'La confirmación de contraseña es obligatoria.',
            'confirmPassword.min' => 'La confirmación de contraseña debe tener al menos :min caracteres.',
            'confirmPassword.same' => 'La confirmación de contraseña no coincide con la contraseña.',
            'red1.string' => 'El valor de la red 1 debe ser una cadena de caracteres.',
            'nombreRed1.string' => 'El nombre de la red 1 debe ser una cadena de caracteres.',
            'red2.string' => 'El valor de la red 2 debe ser una cadena de caracteres.',
            'nombreRed2.string' => 'El nombre de la red 2 debe ser una cadena de caracteres.',
            'inputGroupFile01.file' => 'El archivo 1 debe ser un archivo.',
            'inputGroupFile02.file' => 'El archivo 2 debe ser un archivo.'
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
