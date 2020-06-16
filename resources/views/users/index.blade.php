@extends('layout')

@section('content')
    <h1 class="mt-5">{{ $title }}</h1>
    <hr>

    <ul>
        @forelse ($users as $user)
            <li>{{ $user->name }}, ({{ $user->email }})</li>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </ul>
@endsection
