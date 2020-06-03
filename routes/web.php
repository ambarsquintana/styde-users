<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Home';
});

Route::get('usuarios', function () {
    return 'Usuarios';
});

Route::get('usuarios/nuevo', function () {
    return 'Crear nuevo usuario';
});

Route::get('usuarios/{id}', function ($id) {
   return "Mostrando detalles del usuario {$id}";
});
