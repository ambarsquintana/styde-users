@extends('layout')

@section('content')
    <h1 class="mt-5">{{ $title }}</h1>
    <hr>

    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, ({{ $user->email }})
                <a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles</a>
            </li>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </ul>
@endsection
