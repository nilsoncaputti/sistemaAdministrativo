<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes([
    'register' => false
]);

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('empresas', 'EmpresaController');
    Route::resource('produtos', 'ProdutosController');
    Route::resource('users', 'UsersController');
});

Route::resource('movimentos_financeiros', 'Movimentos_financeirosController');