<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages():array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo E-mail es obligatorio',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida',
            'email.unique' => 'El correo electrónico ya está registrado',
            'password.required' => 'El campo password es obligatorio',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password.symbols' => 'La contraseña debe contener al menos un caracter especial (como !, @, #, etc.)',
            'password.mixed' => 'La contraseña debe contener al menos una letra mayúscula y una letra minúscula',
            'password.uncompromised' => 'La contraseña ha sido expuesta en una filtración de datos, por favor elige una contraseña diferente',
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
            'name' => ['required', 'string'],
            'email' => ['required','email', 'unique:users,email'],//email debe ser único en la tabla users, columna email
            'password' => ['required', 'confirmed', 
                Password::min(8)
                ->letters() //al menos una letra
                ->mixedCase() //al menos una letra mayúscula y una minúscula
                ->symbols() //al menos un símbolo
                ->numbers() //al menos un número
                ->uncompromised()//verifica que la contraseña no haya sido expuesta en una filtración de datos
                ]
        ];
    }
}
