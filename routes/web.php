<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Home';
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

Route::post('/usuarios', 'UserController@store')
    ->name('users.store');

Route::get('/usuarios/{id}', 'UserController@show')
    ->name('users.show');

Route::get('/usuarios/{id}/editar', 'UserController@edit')
    ->name('users.edit');
