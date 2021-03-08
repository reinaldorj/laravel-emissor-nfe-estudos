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
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj')->nullable()->unique();
            $table->string('ie')->nullable()->unique();
            $table->string('iest')->nullable();
            $table->string('im')->nullable();
            $table->string('fone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('email_contabilidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
            $table->string('uf')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cnae')->nullable();
            $table->integer('regime_tributario')->nullable();
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
        Schema::dropIfExists('emitentes');
    }
}
