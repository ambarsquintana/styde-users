@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    <hr>

    <ul>
        @forelse ($users as $user)
            <li>{{ $user }}</li>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </ul>
@endsection
