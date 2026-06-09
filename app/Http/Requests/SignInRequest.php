<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array //personalizamos el mensaje de error de email
    {
        return [
            'email.exists'=> 'No existe una cuenta registrada con este correo electrónico' //mensaje de error personalizado para la regla de validación exists en el campo de correo electrónico, que se mostrará si el correo electrónico ingresado no existe en la base de datos
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','email','exists:users,email'], //regla de validación para el campo de correo electrónico, que requiere que el campo sea obligatorio, tenga un formato de correo electrónico válido y exista en la tabla de usuarios en la base de datos
            'password'=>['required']
        ];
    }
}
