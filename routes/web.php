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
    Route::resource('movimentos_financeiros', 'MovimentoFinanceiroController')->except([
        'edit', 'update'
    ]);
    Route::post('/empresas/buscar-por/nome', 'Selects\EmpresaNomeTipo');
    Route::get('/empresas/relatorio/saldo/{empresa}', 'Relatorios\SaldoEmpresa')->name('empresas.relatorios.saldo');

    Route::delete('/movimentos_estoque/{id}', 'MovimentoEstoqueController@destroy')->name('movimentos_estoque.destroy');
    Route::post('/movimentos_estoque', 'MovimentoEstoqueController@store')->name('movimentos_estoque.store');
    Route::post('/produtos/buscar-por/nome', 'Selects\ProdutoPorNome');
});
