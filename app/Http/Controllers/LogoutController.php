<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    
    public function store()
    {
        Auth::logout(); //cerramos la sesióstorLogoutControlleren del usuario autenticado
        return redirect()->route('login');
    }
}
