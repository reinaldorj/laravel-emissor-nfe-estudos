<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnidadePesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_pesos', function (Blueprint $table) {
            $table->bigIncrements('id_und_peso');
            $table->string('unidade_peso');
            $table->string('sigla');
            $table->timestamps();
        });

        DB::table('unidade_pesos')->insert([
            ['unidade_peso' => 'Quilograma', 'sigla' => 'KG'],
            ['unidade_peso' => 'Grama', 'sigla' => 'GR'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidade_pesos');
    }
}
