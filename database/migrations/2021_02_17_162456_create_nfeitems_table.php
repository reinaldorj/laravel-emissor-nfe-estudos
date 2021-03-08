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
            $table->bigIncrements('id_item_nfe');
            $table->integer('id_venda')->nullable();
            $table->integer('id_produto')->nullable();
            $table->integer('id_nfe')->nullable();
            $table->integer('numero_item')->nullable();
            $table->string('cProd')->nullable();
            $table->string('cEAN')->nullable();
            $table->string('xProd')->nullable();
            $table->string('NCM')->nullable();
            $table->string('cBenef')->nullable();
            $table->string('NVE')->nullable();
            $table->string('EXTIPI')->nullable();
            $table->integer('CFOP')->nullable();
            $table->string('uCom')->nullable();
            $table->decimal('qCom')->nullable();
            $table->decimal('vUnCom')->nullable();
            $table->decimal('vProd')->nullable();
            $table->string('cEANTrib')->nullable();
            $table->string('uTrib')->nullable();
            $table->decimal('qTrib')->nullable();
            $table->decimal('vUnTrib')->nullable();
            $table->decimal('vFrete')->nullable();
            $table->decimal('vSeg')->nullable();
            $table->decimal('vDesc')->nullable();
            $table->decimal('vOutro')->nullable();
            $table->integer('indTot')->nullable();
            $table->string('xPed')->nullable();
            $table->integer('nItemPed')->nullable();
            $table->string('nFCI')->nullable();
            $table->timestamps();
        });

        Schema::table('nfeitems', function(Blueprint $table){
            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade');
        });

        Schema::table('nfeitems', function(Blueprint $table){
            $table->foreign('id_nfe')->references('id_nfe')->on('nves')->onDelete('cascade');
        });

        Schema::table('nfeitems', function(Blueprint $table){
            $table->foreign('id_venda')->references('id_venda')->on('vendas')->onDelete('cascade');
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
