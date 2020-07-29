@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-5 mt-5">
        <h1 class="pb-2">Listado de usuarios</h1>
        <p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario</a>
        </p>
    </div>

    @if ($users->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-list"><span class="oi oi-eye"></span></a>

                        <a href="{{ route('users.edit', $user) }}" class="btn btn-list"><span class="oi oi-pencil"></span></a>

                        <button type="submit" class="btn btn-list"><span class="oi oi-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection
