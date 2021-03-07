<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id_cliente');
            $table->string('nome');
            $table->string('nome_fantasia')->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('cnpj')->nullable()->unique();
            $table->string('fone')->nullable();
            $table->string('celular')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('cep')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('uf')->nullable();
            $table->string('cidade')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('rg')->nullable()->unique();
            $table->string('suframa')->nullable();
            $table->string('cod_estrangeiro')->nullable();
            $table->string('ie_subt_trib')->nullable();
            $table->string('indIEDest')->nullable();
            $table->string('ibge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
