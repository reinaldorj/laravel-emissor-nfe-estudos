<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->namespace('Admin')
->group(function () {
    Route::get('/', 'PrincipalController@index')->name('admin.principal.index');
});