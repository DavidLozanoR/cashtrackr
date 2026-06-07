<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;

class RegisterController extends Controller
{
    
    public function index()
    {
        return view('auth.register');
    }


    public function store(SignupRequest $request) //recibimos los datos del formulario con la clase Request
    {
        $data = $request->validated(); //asignamos su propia funcion Request para validar los datos, esta funcion devuelve un array con los datos validados

        //guardamos en base de datos
        User::create($data); //creamos un nuevo usuario con los datos validados, el modelo User se encarga de guardar en la base de datos


    }

}


