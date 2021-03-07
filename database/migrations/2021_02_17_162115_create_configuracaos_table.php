<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracaos', function (Blueprint $table) {
            $table->bigIncrements('id_configuracao');
            $table->string('layout');
            $table->bigInteger('nfe_serie');
            $table->string('tipo_nota_padrao');
            $table->string('nfe_ambiente');
            $table->string('nfe_versao');
            $table->integer('empresa_padrao');
            $table->integer('ultimanfe');
            $table->string('natureza_padrao');
            $table->string('indFinal');
            $table->string('tipo_frete');
            $table->string('certificado_digital');
            $table->string('senha');
            $table->timestamps();
        });

        Schema::table('configuracaos', function(Blueprint $table){
            $table->foreign('empresa_padrao')->references('id_emitente')->on('emitentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracaos');
    }
}
