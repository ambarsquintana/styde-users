@extends('layout')

@section('title', 'Mostrar Usuario')

@section('content')
    <h1 class="mt-5">Editar Usuario</h1>
    <hr>

    <p>Nombre: {{ $user->name }}</p>
    <p>Correo: {{ $user->email }}</p>
@endsection
