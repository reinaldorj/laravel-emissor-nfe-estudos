<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::delete('/notafiscal/{id}/delete',  'NotaFiscalController@delete')->name('admin.notafiscal.delete');
    Route::put('/notafiscal/{id}/update',     'NotaFiscalController@update')->name('admin.notafiscal.update');
    Route::post('/notafiscal',                'NotaFiscalController@store')->name('admin.notafiscal.store');
    Route::any('/{id}/notafiscal',            'NotaFiscalController@insere')->name('admin.notafiscal.insere');
    Route::get('/notafiscal',                 'NotaFiscalController@index')->name('admin.notafiscal.index');
    Route::any('/notafiscal/search',          'NotaFiscalController@search')->name('admin.notafiscal.search');
    Route::get('/notafiscal/{id}/edit',       'NotaFiscalController@edit')->name('admin.notafiscal.edit');
    Route::get('/notafiscal/{id}/show',       'NotaFiscalController@show')->name('admin.notafiscal.show');
    Route::get('/notafiscal/create',          'NotaFiscalController@create')->name('admin.notafiscal.create');
});