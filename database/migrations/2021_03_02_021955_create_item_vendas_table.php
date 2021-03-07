<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_vendas', function (Blueprint $table) {
            $table->bigIncrements('id_item_venda');
            $table->integer('id_produto');
            $table->integer('id_venda');
            $table->integer('id_cliente');
            $table->decimal('qtde');
            $table->decimal('valor');
            $table->timestamps();
        });

        Schema::table('item_vendas', function(Blueprint $table){
            $table->foreign('id_venda')->references('id_venda')->on('vendas')->onDelete('cascade');
        });

        Schema::table('item_vendas', function(Blueprint $table){
            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_vendas');
    }
}
