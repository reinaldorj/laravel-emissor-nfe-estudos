<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/notas/{id}/delete',  'NotaController@delete')->name('admin.notas.delete');
    Route::put('/notas/{id}/update',     'NotaController@update')->name('admin.notas.update');
    Route::post('/notas',                'NotaController@store')->name('admin.notas.store');
    Route::get('/notas',                 'NotaController@index')->name('admin.notas.index');
    Route::any('/notas/search',          'NotaController@search')->name('admin.notas.search');
    Route::get('/notas/{id}/edit',       'NotaController@edit')->name('admin.notas.edit');
    Route::get('/notas/{id}/show',       'NotaController@show')->name('admin.notas.show');
    Route::get('/notas/create',          'NotaController@create')->name('admin.notas.create');
});