<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfedestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfedestinatarios', function (Blueprint $table) {
            $table->bigIncrements('id_destinatario');
            $table->integer('id_nfe');
            $table->string('dest_xNome');
            $table->string('dest_IE');
            $table->string('dest_indIEDest');
            $table->integer('dest_ISUF');
            $table->string('dest_IM');
            $table->string('dest_email');
            $table->string('dest_CNPJ');
            $table->string('dest_CPF');
            $table->string('dest_idEstrangeiro');
            $table->string('dest_xLgr');
            $table->string('dest_nro');
            $table->string('dest_xCpl');
            $table->string('dest_xBairro');
            $table->integer('dest_cMun');
            $table->string('dest_xMun');
            $table->char('dest_UF', 2);
            $table->string('dest_CEP');
            $table->integer('dest_cPais');
            $table->string('dest_xPais');
            $table->string('dest_fone');
            $table->timestamps();
        });

        Schema::table('nfedestinatarios', function(Blueprint $table){
            $table->foreign('id_nfe')->references('id_nfe')->on('nves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nfedestinatarios');
    }
}
