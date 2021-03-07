<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmitentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emitentes', function (Blueprint $table) {
            $table->bigIncrements('id_emitente');
            $table->string('razao_social')->unique();
            $table->string('nome_fantasia');
            $table->string('cnpj')->unique();
            $table->string('ie')->unique();
            $table->string('iest');
            $table->string('im');
            $table->string('fone');
            $table->string('email')->unique();
            $table->string('email_contabilidade');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('complemento');
            $table->string('numero');
            $table->string('uf');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('cnae');
            $table->integer('regime_tributario');
            $table->string('ibge');
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
        Schema::dropIfExists('emitentes');
    }
}
