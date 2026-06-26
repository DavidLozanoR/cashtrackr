@extends('layouts.auth')

@section('title')
    Administra tus presupuestos

@endsection

@section('auth-contents')

<h1 class="text-4xl">Administra tus Presupuestos</h1>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />   <!--  Props con ":" lo hace dinamico -->    
    @endif


@endsection