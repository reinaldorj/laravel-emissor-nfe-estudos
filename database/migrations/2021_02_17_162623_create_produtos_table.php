<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id_produto');
            $table->integer('id_unidade');
            $table->string('produto');
            $table->decimal('preco');
            $table->integer('cfop')->nullable();
            $table->string('gtin')->nullable();
            $table->string('ncm')->nullable();
            $table->string('cest')->nullable();
            $table->string('cbenef')->nullable();
            $table->string('extipi')->nullable();
            $table->decimal('mva')->nullable();
            $table->string('nfci')->nullable();
            $table->string('sku')->nullable()->unique();
            $table->decimal('quantidade')->nullable();
            $table->decimal('peso')->nullable();
            $table->integer('id_und_medida')->nullable();
            $table->integer('id_und_peso')->nullable();
            $table->decimal('comprimento')->nullable();
            $table->decimal('largura')->nullable();
            $table->decimal('altura')->nullable();
            $table->timestamps();
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->foreign('id_unidade')->references('id_unidade')->on('unidades')->onDelete('cascade');
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->foreign('id_und_medida')->references('id_und_medida')->on('unidade_medidas')->onDelete('cascade');
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->foreign('id_und_peso')->references('id_und_peso')->on('unidade_pesos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
