<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id_estado');
            $table->string('nome_estado');
            $table->string('uf_estado');
            $table->string('codigo_estado');
            $table->timestamps();
        });

        DB::table('estados')->insert([
            ['nome_estado' => 'Acre', 'uf_estado'                   => 'AC', 'codigo_estado' => '12'],
            ['nome_estado' => 'Alagoas', 'uf_estado'                => 'AL', 'codigo_estado' => '27'],
            ['nome_estado' => 'Amapá', 'uf_estado'                  => 'AP', 'codigo_estado' => '16'],
            ['nome_estado' => 'Amazonas', 'uf_estado'               => 'AM', 'codigo_estado' => '13'],
            ['nome_estado' => 'Bahia', 'uf_estado'                  => 'BA', 'codigo_estado' => '29'],
            ['nome_estado' => 'Ceará', 'uf_estado'                  => 'CE', 'codigo_estado' => '23'],
            ['nome_estado' => 'Distrito Federal', 'uf_estado'       => 'DF', 'codigo_estado' => '53'],
            ['nome_estado' => 'Espírito Santo', 'uf_estado'         => 'ES', 'codigo_estado' => '32'],
            ['nome_estado' => 'Goiás', 'uf_estado'                  => 'GO', 'codigo_estado' => '52'],
            ['nome_estado' => 'Maranhão', 'uf_estado'               => 'MA', 'codigo_estado' => '21'],
            ['nome_estado' => 'Mato Grosso do Sul', 'uf_estado'     => 'MS', 'codigo_estado' => '50'],
            ['nome_estado' => 'Mato Grosso', 'uf_estado'            => 'MT', 'codigo_estado' => '51'],
            ['nome_estado' => 'Minas Gerais', 'uf_estado'           => 'MG', 'codigo_estado' => '31'],
            ['nome_estado' => 'Paraná', 'uf_estado'                 => 'PR', 'codigo_estado' => '41'],
            ['nome_estado' => 'Paraíba', 'uf_estado'                => 'PB', 'codigo_estado' => '25'],
            ['nome_estado' => 'Pará', 'uf_estado'                   => 'PA', 'codigo_estado' => '15'],
            ['nome_estado' => 'Pernambuco', 'uf_estado'             => 'PE', 'codigo_estado' => '26'],
            ['nome_estado' => 'Piauí', 'uf_estado'                  => 'PI', 'codigo_estado' => '22'],
            ['nome_estado' => 'Rio de Janeiro', 'uf_estado'         => 'RJ', 'codigo_estado' => '33'],
            ['nome_estado' => 'Rio Grande do Norte', 'uf_estado'    => 'RN', 'codigo_estado' => '24'],
            ['nome_estado' => 'Rio Grande do Sul', 'uf_estado'      => 'RS', 'codigo_estado' => '43'],
            ['nome_estado' => 'Rondônia', 'uf_estado'               => 'RO', 'codigo_estado' => '11'],
            ['nome_estado' => 'Roraima', 'uf_estado'                => 'RR', 'codigo_estado' => '14'],
            ['nome_estado' => 'Santa Catarina', 'uf_estado'         => 'SC', 'codigo_estado' => '42'],
            ['nome_estado' => 'Sergipe', 'uf_estado'                => 'SE', 'codigo_estado' => '28'],
            ['nome_estado' => 'São Paulo', 'uf_estado'              => 'SP', 'codigo_estado' => '35'],
            ['nome_estado' => 'Tocantins', 'uf_estado'              => 'TO', 'codigo_estado' => '17']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
