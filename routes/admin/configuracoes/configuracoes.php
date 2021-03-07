<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/configuracoes/{id}/delete',  'ConfiguracaoController@delete')->name('admin.configuracoes.delete');
    Route::put('/configuracoes/{id}/update',     'ConfiguracaoController@update')->name('admin.configuracoes.update');
    Route::post('/configuracoes',                'ConfiguracaoController@store')->name('admin.configuracoes.store');
    Route::get('/configuracoes',                 'ConfiguracaoController@index')->name('admin.configuracoes.index');
    Route::any('/configuracoes/search',          'ConfiguracaoController@search')->name('admin.configuracoes.search');
    Route::get('/configuracoes/{id}/edit',       'ConfiguracaoController@edit')->name('admin.configuracoes.edit');
    Route::get('/configuracoes/{id}/show',       'ConfiguracaoController@show')->name('admin.configuracoes.show');
    Route::get('/configuracoes/create',          'ConfiguracaoController@create')->name('admin.configuracoes.create');
});