<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->bigIncrements('id_unidade');
            $table->string('unidade');
            $table->string('abrev');
            $table->timestamps();
        });


        DB::table('unidades')->insert([
            ['unidade' => 'UNIDADE',    'abrev' => 'UNID'],
            ['unidade' => 'PACOTE',     'abrev' => 'PCT'],
            ['unidade' => 'KILOGRAMA',  'abrev' => 'KG']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
