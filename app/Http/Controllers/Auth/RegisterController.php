<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest; //importamos la clase SignupRequest que contiene las reglas de validación para el formulario de registro
use App\Models\User; //importamos el modelo User para poder crear un nuevo usuario en la base de datos con los datos validados del formulario de registro
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    
    public function index() //muestra el formulario de registro
    {
        return view('auth.register'); //vista
    }


    public function store(SignupRequest $request) //recibimos los datos del formulario con la clase Request propia del formulario de registro
    {
        $data = $request->validated(); //asignamos su propia funcion Request para validar los datos, esta funcion devuelve un array con los datos validados

        //guardamos en base de datos si paso la validación
        $user = User::create($data); //creamos un nuevo usuario con los datos validados, el modelo User se encarga de guardar en la base de datos

        event(new Registered($user)); //disparamos el evento Registered que se encarga de enviar el correo de verificación al usuario registrado

        Auth::login($user); //iniciamos sesión automáticamente después de registrarse, registramos cookis

        return redirect()->route('verification.notice'); //redireccionamos a la página de verificación de correo electrónico, esta ruta se encarga de mostrar un mensaje indicando al usuario que debe verificar su correo electrónico para completar el registro

    }

}


