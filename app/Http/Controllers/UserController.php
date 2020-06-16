<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'title' => 'Crear usuarios'
        ]);
    }

    public function show($id)
    {
        return view('users.show', [
            'id' => $id,
            'title' => 'Mostrar usuarios'
        ]);
    }

    public function edit($id)
    {
        return view('users.edit', [
            'id' => $id,
            'title' => 'Editar usuarios'
        ]);
    }
}
