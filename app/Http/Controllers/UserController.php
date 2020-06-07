<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return 'Usuarios';
    }

    public function create() {
        return 'Crear nuevo usuario';
    }

    public function show($id) {
        return "Mostrando detalles del usuario {$id}";
    }

    public function edit($id) {
        return "Editando usuario {$id}";
    }
}
