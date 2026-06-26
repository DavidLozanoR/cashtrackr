<?php

use \Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/register',[RegisterController::class,'index'])->name('register');
Route::post('/auth/register',[RegisterController::class,'store'])->name('register.store');

Route::get('/auth/login',[LoginController::class,'index'])->name('login');
Route::post('/auth/login',[LoginController::class,'store'])->name('login.store');// ruta para procesar el formulario de inicio de sesión

Route::get('/email/verify/{id}/{hash}',function(EmailVerificationRequest $request){
    $request->fulfill(); //verifica el enlace de verificación, si es válido marca el correo electrónico del usuario como verificado en la base de datos

    return redirect()->route('dashboard')->with('success','Tu correo fue verificado Correctamente. Ya 
    puedes Crear Presupuestos y Gastos.'); //redirecciona al dashboard con un mensaje de éxito indicando que el correo fue verificado correctamente y que el usuario ya puede crear presupuestos y gastos
})->middleware(['auth', 'signed'])->name('verification.verify'); //middleware auth para asegurarnos de que el usuario esté autenticado antes de verificar su correo electrónico, middleware signed para asegurarnos de que la URL de verificación esté firmada y sea válida, nombre de ruta verification.verify para generar la URL de verificación en la notificación de correo electrónico


Route::get('/email/verify', function() {
    return view('auth.verify-email'); //vista que muestra un mensaje indicando al usuario que debe verificar su correo electrónico para completar el registro
})->middleware('auth')->name('verification.notice');//middleware auth para asegurarnos de que el usuario esté autenticado antes de mostrar la página de verificación, nombre de ruta verification.notice para redireccionar a esta página después de registrarse

Route::post('/email/verifica', function(Request $request) {
    $request->user()->sendEmailVerificationNotification(); //envía un correo electrónico de verificación al usuario autenticado utilizando el método sendEmailVerificationNotification() del modelo User

    return back()->with('success','Se ha enviado un nuevo enlace de verificación a tu correo electrónico.'); //redirecciona a la página anterior con un mensaje de éxito indicando que se ha enviado un nuevo enlace de verificación al correo electrónico del usuario
})->middleware(['auth', 'throttle:1,1'])->name('verification.send'); //middleware auth para asegurarnos de que el usuario esté autenticado antes de enviar el correo electrónico de verificación, middleware throttle para limitar la cantidad de solicitudes que un usuario puede hacer en un período de tiempo determinado (1 solicitudes por minuto en este caso), nombre de ruta verification.send para generar la URL para enviar el correo electrónico de verificación



Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); //middleware auth para asegurarnos de que el usuario esté autenticado antes de acceder al dashboard, middleware verified para asegurarnos de que el usuario haya verificado su correo electrónico antes de acceder al dashboard, nombre de ruta dashboard para redireccionar a esta página después de verificar el correo electrónico