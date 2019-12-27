<?php


Route::get('/', 'AlimentoController@index');

Route::match(['get', 'post'], '/alimentos/Pesquisa/', 'AlimentoController@search')->name('alimentos.search');
Route::get('alimentos/deletar/{id}', 'AlimentoController@destroyOne')->name('alimentos.destroyOne');
Route::match(['get', 'post'], 'alimentos/deletar-varios/', 'AlimentoController@destroyMany')->name('alimentos.destroyMany');
Route::resource('alimentos','AlimentoController');
