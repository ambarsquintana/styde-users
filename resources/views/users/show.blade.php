@extends('layout')

@section('title', 'Mostrar Usuario')

@section('content')
    <h1 class="mt-5">Mostrar Usuario</h1>
    <hr>

    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="John Dae" value="{{ $user->name }}" disabled class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" placeholder="johndae@example.com" value="{{ $user->email }}" disabled class="form-control">
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-link">Regresar</a>
@endsection
