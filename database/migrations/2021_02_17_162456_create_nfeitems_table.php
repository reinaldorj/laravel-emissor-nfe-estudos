<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfeitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfeitems', function (Blueprint $table) {
            $table->bigIncrements('id_item');
            $table->integer('id_produto');
            $table->integer('id_nfe');
            $table->integer('numero_item');
            $table->string('cProd');
            $table->string('cEAN');
            $table->string('xProd');
            $table->string('NCM');
            $table->string('cBenef');
            $table->string('NVE');
            $table->string('EXTIPI');
            $table->integer('CFOP');
            $table->string('uCom');
            $table->decimal('qCom');
            $table->decimal('vUnCom');
            $table->decimal('vProd');
            $table->string('cEANTrib');
            $table->string('uTrib');
            $table->decimal('qTrib');
            $table->decimal('vUnTrib');
            $table->decimal('vFrete');
            $table->decimal('vSeg');
            $table->decimal('vDesc');
            $table->decimal('vOutro');
            $table->integer('indTot');
            $table->string('xPed');
            $table->integer('nItemPed');
            $table->string('nFCI');
            $table->timestamps();
        });

        Schema::table('nfeitems', function(Blueprint $table){
            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade');
        });

        Schema::table('nfeitems', function(Blueprint $table){
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
        Schema::dropIfExists('nfeitems');
    }
}
