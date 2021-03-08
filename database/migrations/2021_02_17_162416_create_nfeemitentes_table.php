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
            $table->integer('id_nfe')->nullable();
            $table->string('em_xNome')->nullable();
            $table->string('em_xFant')->nullable();
            $table->string('em_IE')->nullable();
            $table->string('em_IEST')->nullable();
            $table->string('em_IM')->nullable();
            $table->string('em_CNAE')->nullable();
            $table->char('em_CRT',1)->nullable();
            $table->string('em_CNPJ')->nullable();
            $table->string('em_CPF')->nullable();
            $table->string('em_xLgr')->nullable();
            $table->string('em_nro')->nullable();
            $table->string('em_xCpl')->nullable();
            $table->string('em_xBairro')->nullable();
            $table->integer('em_cMun')->nullable();
            $table->string('em_xMun')->nullable();
            $table->char('em_UF', 2)->nullable();
            $table->string('em_CEP')->nullable();
            $table->integer('em_cPais')->nullable();
            $table->string('em_xPais')->nullable();
            $table->string('em_fone')->nullable();
            $table->string('em_EMAIL')->nullable();
            $table->integer('em_SUFRAMA')->nullable();
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
