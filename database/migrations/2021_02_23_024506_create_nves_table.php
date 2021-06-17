<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nves', function (Blueprint $table) {
            $table->bigIncrements('id_nfe');//1
            $table->integer('id_venda')->nullable();
            $table->integer('id_status')->nullable();//2
            $table->string('chave')->nullable();
            $table->string('recibo')->nullable();
            $table->string('protocolo')->nullable();
            $table->integer('cUF')->nullable();//3
            $table->string('cNF')->nullable();//4
            $table->string('natOp')->nullable();//5
            $table->integer('indPag')->nullable();//6
            $table->char('modelo', 2)->nullable();//7
            $table->char('serie', 3)->nullable();//8
            $table->string('nNF')->nullable();//9
            $table->string('dhEmi')->nullable();//10
            $table->string('dhSaiEnt')->nullable();//11
            $table->integer('tpNF')->nullable();//12
            $table->integer('idDest')->nullable();//13
            $table->integer('cMunFG')->nullable();//14
            $table->integer('tpImp')->nullable();//15
            $table->integer('tpEmis')->nullable();//16
            $table->string('cDV')->nullable();//17
            $table->integer('tpAmb')->nullable();//18
            $table->integer('finNFe')->nullable();//19
            $table->integer('indFinal')->nullable();//20
            $table->integer('indPres')->nullable();//21
            $table->integer('procEmi')->nullable();//22
            $table->string('verProc');//23
            $table->date('dhCont')->nullable();//24
            $table->string('xJust')->nullable();//25
            $table->decimal('vBC')->nullable();//26
            $table->decimal('vICMS')->nullable();//27
            $table->decimal('vICMSDeson')->nullable();//28
            $table->decimal('vFCP')->nullable();//29
            $table->decimal('vBCST')->nullable();//30
            $table->decimal('vST')->nullable();//31
            $table->decimal('vFCPST')->nullable();//32
            $table->decimal('vFCPSTRet')->nullable();//33
            $table->decimal('vProd')->nullable();//34
            $table->decimal('vFrete')->nullable();//35
            $table->decimal('vSeg')->nullable();//36
            $table->decimal('vDesc')->nullable();//37
            $table->decimal('vII')->nullable();//38
            $table->decimal('vIPI')->nullable();//39
            $table->decimal('vIPIDevol')->nullable();//40
            $table->decimal('vPIS')->nullable();//41
            $table->decimal('vCOFINS')->nullable();//42
            $table->decimal('vOutro')->nullable();//43
            $table->decimal('vNF')->nullable();//44
            $table->decimal('vTotTrib')->nullable();//45
            $table->decimal('vOrig')->nullable();//46
            $table->decimal('vLiq')->nullable();//47
            $table->integer('status_nota')->nullable();//48
            $table->string('finalizado')->nullable();//49
            $table->dateTime('atualizacao_emitente')->nullable();
            $table->timestamps();
        });

        Schema::table('nves', function(Blueprint $table){
            $table->foreign('id_venda')->references('id_venda')->on('vendas')->onDelete('cascade');
        });

        Schema::table('nves', function(Blueprint $table){
            $table->foreign('id_status')->references('id_status')->on('nfestatuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nves');
    }
}
