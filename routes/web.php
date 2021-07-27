<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('empresas', 'EmpresaController');

Route::resource('produtos', 'ProdutosController');
Route::resource('produtos', 'ProdutosController');