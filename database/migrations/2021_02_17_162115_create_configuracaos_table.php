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
            $table->string('layout')->nullable();
            $table->bigInteger('nfe_serie')->nullable();
            $table->string('tipo_nota_padrao')->nullable();
            $table->string('nfe_ambiente')->nullable();
            $table->string('nfe_versao')->nullable();
            $table->integer('empresa_padrao')->nullable();
            $table->integer('ultimanfe')->nullable();
            $table->string('natureza_padrao')->nullable();
            $table->string('indFinal')->nullable();
            $table->string('tipo_frete')->nullable();
            $table->string('certificado_digital')->nullable();
            $table->string('senha')->nullable();
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
