@extends('layout')

@section('title', 'Editar Usuario')

@section('content')
    <h1 class="mt-5">Editar usuarios</h1>
    <hr>

    <form method="POST" action="">
        @csrf

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="John Dae" value="{{ old('name', $user->name) }}">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" placeholder="johndae@example.com" value="{{ old('email', $user->email) }}">
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="********">
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar</a>
    </p>
@endsection
