<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Home';
});

Route::get('/usuarios', 'UserController@index');

Route::get('/usuarios/nuevo', 'UserController@create');

Route::get('/usuarios/{id}', 'UserController@show');

Route::get('/usuarios/{id}/edit', 'UserController@edit');
