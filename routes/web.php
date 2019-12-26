<?php


Route::get('/', 'AlimentoController@index');

Route::match(['get', 'post'], '/alimentos/Pesquisa/', 'AlimentoController@search')->name('alimentos.search');
Route::resource('alimentos','AlimentoController');
