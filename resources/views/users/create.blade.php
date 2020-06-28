@extends('layout')

@section('title', 'Crear Usuario')

@section('content')
    <h1 class="mt-5">{{ $title }}</h1>
    <hr>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar</a>
    </p>
@endsection
