<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/produtos/{id}/delete',  'ProdutoController@delete')->name('admin.produto.delete');
    Route::put('/produtos/{id}/update',     'ProdutoController@update')->name('admin.produtos.update');
    Route::post('/produtos',                'ProdutoController@store')->name('admin.produtos.store');
    Route::get('/produtos',                 'ProdutoController@index')->name('admin.produtos.index');
    Route::any('/produtos/search',          'ProdutoController@search')->name('admin.produtos.search');
    Route::get('/produtos/{id}/edit',       'ProdutoController@edit')->name('admin.produtos.edit');
    Route::get('/produtos/{id}/show',       'ProdutoController@show')->name('admin.produtos.show');
    Route::get('/produtos/create',          'ProdutoController@create')->name('admin.produtos.create');
});