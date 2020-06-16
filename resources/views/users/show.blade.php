@extends('layout')

@section('title', 'Mostrar Usuario')

@section('content')
    <h1 class="mt-5">{{ $title }}</h1>
    <hr>

    <p>Mostrando detalles del usuario {{ $id }}</p>
@endsection
