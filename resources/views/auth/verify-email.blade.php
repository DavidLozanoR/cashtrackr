
@extends('layouts.auth')

@section('title')
    Confirma tu cuenta
@endsection


@section('auth-contents')

<h1 class="text-4xl font-bold">Confirma tu cuenta</h1>

<p class="mt-5 text-lg">Gracias por registrarte! Antes de continuar, por favor verifica tu correo electrónico haciendo clic en el enlace que te hemos enviado.</p>

@if (session('success')) <!-- Verifica si hay un mensaje de error en la sesión, lo que indicaría que las credenciales de inicio de sesión son incorrectas -->
     <x-alert  :message="session('success')" />   <!--  Props con ":" lo hace dinamico -->

@endif


<form method="POST" action= "{{ route('verification.send') }}">
    <input
        type="submit" 
        value='Reenviar correo de verificación'
        class="bg-amber-500 text-center w-full py-2 mt-5 px-5 uppercase font-bold cursor-pointer hover:bg-amber-600 transition-colors rounded-lg text-white"
    />
</form>

@endsection