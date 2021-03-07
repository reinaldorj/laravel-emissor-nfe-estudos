<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnidadeMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_medidas', function (Blueprint $table) {
            $table->bigIncrements('id_und_medida');
            $table->string('unidade_medida');
            $table->string('sigla');
            $table->timestamps();
        });

        DB::table('unidade_medidas')->insert([
            ['unidade_medida' => 'Centimetro', 'sigla' => 'cm'],
            ['unidade_medida' => 'Milímetro', 'sigla' => 'mm']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidade_medidas');
    }
}
