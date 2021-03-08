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
            $table->integer('id_nfe')->nullable();
            $table->string('dest_xNome')->nullable();
            $table->string('dest_IE')->nullable();
            $table->string('dest_indIEDest')->nullable();
            $table->integer('dest_ISUF')->nullable();
            $table->string('dest_IM')->nullable();
            $table->string('dest_email')->nullable();
            $table->string('dest_CNPJ')->nullable();
            $table->string('dest_CPF')->nullable();
            $table->string('dest_idEstrangeiro')->nullable();
            $table->string('dest_xLgr')->nullable();
            $table->string('dest_nro')->nullable();
            $table->string('dest_xCpl')->nullable();
            $table->string('dest_xBairro')->nullable();
            $table->integer('dest_cMun')->nullable();
            $table->string('dest_xMun')->nullable();
            $table->char('dest_UF', 2)->nullable();
            $table->string('dest_CEP')->nullable();
            $table->integer('dest_cPais')->nullable();
            $table->string('dest_xPais')->nullable();
            $table->string('dest_fone')->nullable();
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
