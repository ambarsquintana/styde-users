@extends('layout')

@section('title', 'Mostrar Usuario')

@section('content')
    <h1 class="mt-5">Mostrar Usuario</h1>
    <hr>

    <p>Nombre: {{ $user->name }}</p>
    <p>Correo: {{ $user->email }}</p>

    <p>
        <a href="{{ route('users.index') }}">Regresar</a>
    </p>
@endsection
