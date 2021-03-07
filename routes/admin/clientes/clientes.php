<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/clientes/{id}/delete',  'ClienteController@delete')->name('admin.clientes.delete');
    Route::put('/clientes/{id}/update',     'ClienteController@update')->name('admin.clientes.update');
    Route::post('/clientes',                'ClienteController@store')->name('admin.clientes.store');
    Route::get('/clientes',                 'ClienteController@index')->name('admin.clientes.index');
    Route::any('/clientes/search',          'ClienteController@search')->name('admin.clientes.search');
    Route::get('/clientes/{id}/edit',       'ClienteController@edit')->name('admin.clientes.edit');
    Route::get('/clientes/{id}/show',       'ClienteController@show')->name('admin.clientes.show');
    Route::get('/clientes/create',          'ClienteController@create')->name('admin.clientes.create');
});