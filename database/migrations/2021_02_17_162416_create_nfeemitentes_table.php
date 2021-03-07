<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfeemitentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfeemitentes', function (Blueprint $table) {
            $table->bigIncrements('id_nfe_emitente');
            $table->string('em_xNome');
            $table->string('em_xFant');
            $table->string('em_IE');
            $table->string('em_IEST');
            $table->string('em_IM');
            $table->string('em_CNAE');
            $table->char('em_CRT',1);
            $table->string('em_CNPJ');
            $table->string('em_CPF');
            $table->string('em_xLgr');
            $table->string('em_nro');
            $table->string('em_xCpl');
            $table->string('em_xBairro');
            $table->integer('em_cMun');
            $table->string('em_xMun');
            $table->char('em_UF', 2);
            $table->string('em_CEP');
            $table->integer('em_cPais');
            $table->string('em_xPais');
            $table->string('em_fone');
            $table->string('em_EMAIL');
            $table->integer('em_SUFRAMA');
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
        Schema::dropIfExists('nfeemitentes');
    }
}
