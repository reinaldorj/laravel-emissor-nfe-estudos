<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin\\Nfe')
->group(function () {
    Route::get('/nfe/{id}/gerarnfe',                 'NfeController@gerarnfe')->name('admin.nfe.gerarnfe');
    Route::get('/nfe/{id}/assinarnfe',                 'NfeController@assinarnfe')->name('admin.nfe.assinarnfe');
    /*Route::delete('/nfe/{id}/delete',  'NfeController@delete')->name('admin.nfe.delete');
    Route::put('/nfe/{id}/update',     'NfeController@update')->name('admin.nfe.update');
    Route::any('/{id}/nfe',           'NfeController@insere')->name('admin.nfe.insere');
    Route::get('/nfe',                 'NfeController@index')->name('admin.nfe.index');
    Route::any('/nfe/search',          'NfeController@search')->name('admin.nfe.search');
    Route::get('/nfe/{id}/edit',       'NfeController@edit')->name('admin.nfe.edit');
    Route::get('/nfe/{id}/show',       'NfeController@show')->name('admin.nfe.show');
    Route::get('/nfe/create',          'NfeController@create')->name('admin.nfe.create');*/
});