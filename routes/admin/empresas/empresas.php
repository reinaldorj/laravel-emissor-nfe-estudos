<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/empresas/{id}/delete',  'EmpresaController@delete')->name('admin.empresas.delete');
    Route::put('/empresas/{id}/update',     'EmpresaController@update')->name('admin.empresas.update');
    Route::post('/empresas',                'EmpresaController@store')->name('admin.empresas.store');
    Route::get('/empresas',                 'EmpresaController@index')->name('admin.empresas.index');
    Route::any('/empresas/search',          'EmpresaController@search')->name('admin.empresas.search');
    Route::get('/empresas/{id}/edit',       'EmpresaController@edit')->name('admin.empresas.edit');
    Route::get('/empresas/{id}/show',       'EmpresaController@show')->name('admin.empresas.show');
    Route::get('/empresas/create',          'EmpresaController@create')->name('admin.empresas.create');
});