<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->bigIncrements('id_venda');
            $table->integer('id_cliente')->nullable();
            $table->date('data_venda')->nullable();
            $table->time('hora_venda')->nullable();
            $table->decimal('total')->nullable();
            $table->string('finalizado')->nullable();
            $table->timestamps();
        });

        Schema::table('vendas', function(Blueprint $table){
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
