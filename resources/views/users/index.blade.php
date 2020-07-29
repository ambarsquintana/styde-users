@extends('layout')

@section('content')
    <h1 class="mt-5">Listado de usuarios</h1>
    <p>
        <a href="{{ route('users.create') }}">Crear Usuarios</a>
    </p>
    <hr>

    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, ({{ $user->email }})
                <a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles</a> |
                <a href="{{ route('users.edit', $user) }}">Editar Usuario</a> |
                <form action="{{ route('users.destroy', $user) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Eliminar usuarios</button>
                </form>
            </li>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </ul>
@endsection
