<?php

use Illuminate\Support\Facades\Route;

include 'admin/principal/principal.php';
include 'admin/catalogo/produtos/produtos.php';
include 'admin/empresas/empresas.php';
include 'admin/clientes/clientes.php';
include 'admin/notas/notas.php';
include 'admin/vendas/vendas.php';
include 'admin/configuracoes/configuracoes.php';

Route::get('/', function () {
    return view('welcome');
});
