@extends('layouts.auth')

@section('title')
    Administra tus presupuestos

@endsection

@section('auth-contents')

<h1 class="text-4xl">Administra tus Presupuestos</h1>

@if (session('success'))
   <p class="my-10 text-center border border-green-400 bg-green-100 text-green-700 py-3 text-sm">{{ session('success') }}</p>
@endif


@endsection