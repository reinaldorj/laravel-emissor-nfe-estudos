<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNfestatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfestatuses', function (Blueprint $table) {
            $table->bigIncrements('id_status');
            $table->string('status');
            $table->timestamps();
        });

        DB::table('nfestatuses')->insert([
            ['status' => 'Em Digitação'],
            ['status' => 'Validada'],
            ['status' => 'Assinada'],
            ['status' => 'Em processamento na SEFAZ'],
            ['status' => 'Autorizada'],
            ['status' => 'Cancelada'],
            ['status' => 'Denegada'],
            ['status' => 'Rejeitada']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nfestatuses');
    }
}
