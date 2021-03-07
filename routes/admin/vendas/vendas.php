<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/vendas/{id}/delete',                    'VendaController@delete')->name('admin.vendas.delete');
    Route::delete('/vendas/{iditem}/deleteitem/{id}',       'VendaController@deleteitem')->name('admin.vendas.deleteitem');
    Route::put('/vendas/{id}/update',                       'VendaController@update')->name('admin.vendas.update');
    Route::put('/vendas/{id}/finalizavenda',                'VendaController@finalizavenda')->name('admin.vendas.finalizavenda');
    Route::post('/vendas',                                  'VendaController@store')->name('admin.vendas.store');
    Route::post('/vendas/insereItem',                       'VendaController@insereItem')->name('admin.vendas.insereItem');
    Route::get('/vendas',                                   'VendaController@index')->name('admin.vendas.index');
    Route::any('/vendas/search',                            'VendaController@search')->name('admin.vendas.search');
    Route::get('/vendas/{id}/edit',                         'VendaController@edit')->name('admin.vendas.edit');
    Route::get('/vendas/{id}/show',                         'VendaController@show')->name('admin.vendas.show');
    Route::get('/vendas/create',                            'VendaController@create')->name('admin.vendas.create');
    Route::get('/vendas/pesquisa',                          'VendaController@pesquisa')->name('admin.vendas.pesquisa');
    Route::get('/vendas/pesquisaproduto',                   'VendaController@pesquisaProduto')->name('admin.vendas.pesquisaProduto');
    Route::get('/vendas/{id}/detalhe',                      'VendaController@detalhe')->name('admin.vendas.detalhe');
});