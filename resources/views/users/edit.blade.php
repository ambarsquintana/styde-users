@extends('layout')

@section('title', 'Editar Usuario')

@section('content')
    <h1 class="mt-5">Editar usuarios</h1>
    <hr>

    <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" placeholder="John Dae" value="{{ old('name', $user->name) }}" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" placeholder="johndae@example.com" value="{{ old('email', $user->email) }}" class="form-control">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" placeholder="********" class="form-control">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('users.index') }}" class="btn btn-link">Regresar</a>
    </form>
@endsection
