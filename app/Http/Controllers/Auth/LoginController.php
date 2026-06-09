<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');//vista
    }

    public function store(SignInRequest $request){ 
        $data = $request->validated(); //obtiene los datos validados del formulario de inicio de sesión utilizando el método validated() del objeto SignInRequest, que se encarga de validar los datos según las reglas definidas en ese FormRequest


        if(!Auth::attempt($data)){
            return back()->with('error','Credenciales Incorrectas'); //Regresamos a la pagina anterior, el error se consume con "session" en la vista
        }

    }


}
