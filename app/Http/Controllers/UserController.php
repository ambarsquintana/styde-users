<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (request()->has('empty')) {
            $users = [];
        } else {
            $users = [
                'Pedro',
                'Jose',
                'Ana'
            ];
        }

        return view('users', [
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);
    }

    public function create()
    {
        return view('user-create', [
            'title' => 'Crear usuarios'
        ]);
    }

    public function show($id)
    {
        return view('user-show', [
            'id' => $id,
            'title' => 'Mostrar usuarios'
        ]);
    }

    public function edit($id)
    {
        return view('user-edit', [
            'id' => $id,
            'title' => 'Editar usuarios'
        ]);
    }
}
