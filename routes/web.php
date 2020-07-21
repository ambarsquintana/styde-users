<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Home';
});

Route::get('usuarios', 'UserController@index')
    ->name('users.index');

Route::get('usuarios/{id}', 'UserController@show')
    ->name('users.show');

Route::get('usuarios/crear', 'UserController@create')
    ->name('users.create');

Route::post('usuarios', 'UserController@store')
    ->name('users.store');

Route::get('usuarios/{user}/editar', 'UserController@edit')
    ->name('users.edit');

Route::put('usuarios/{user}', 'UserController@update')
    ->name('users.update');
