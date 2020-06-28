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
            'title' => 'Listado de usuarios',
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'title' => 'Crear usuarios',
        ]);
    }

    public function store()
    {
        return "Procesando información...";
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        return view('users.edit', [
            'id' => $id,
            'title' => 'Editar usuarios',
        ]);
    }
}
