@extends('layout')

@section('title', 'Crear Usuario')

@section('content')
    <h1 class="mt-5">Crear usuarios</h1>
    <hr>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" placeholder="John Dae" value="{{ old('name') }}" class="form-control">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" placeholder="johndae@example.com" value="{{ old('email') }}" class="form-control">
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

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="{{ route('users.index') }}"" class="btn btn-link">Regresar</a>
    </form>
@endsection
