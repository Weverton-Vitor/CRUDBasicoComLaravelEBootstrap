<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProdutosController@index');

Route::match(['get', 'post'], '/Produtos/Pesquisa', 'ProdutosController@search')->name('produtos.search');
Route::resource('produtos','ProdutosController');
