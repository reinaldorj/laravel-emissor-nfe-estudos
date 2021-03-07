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
            $table->integer('id_status');//2
            $table->integer('cUF');//3
            $table->string('cNF');//4
            $table->string('natOp');//5
            $table->integer('indPag');//6
            $table->char('modelo', 2);//7
            $table->char('serie', 3);//8
            $table->string('nNF');//9
            $table->string('dhEmi');//10
            $table->string('dhSaiEnt');//11
            $table->integer('tpNF');//12
            $table->integer('idDest');//13
            $table->integer('cMunFG');//14
            $table->integer('tpImp');//15
            $table->integer('tpEmis');//16
            $table->string('cDV');//17
            $table->integer('tpAmb');//18
            $table->integer('finNFe');//19
            $table->integer('indFinal');//20
            $table->integer('indPres');//21
            $table->integer('procEmi');//22
            $table->string('verProc');//23
            $table->date('dhCont');//24
            $table->string('xJust');//25
            $table->decimal('vBC');//26
            $table->decimal('vICMS');//27
            $table->decimal('vICMSDeson');//28
            $table->decimal('vFCP');//29
            $table->decimal('vBCST');//30
            $table->decimal('vST');//31
            $table->decimal('vFCPST');//32
            $table->decimal('vFCPSTRet');//33
            $table->decimal('vProd');//34
            $table->decimal('vFrete');//35
            $table->decimal('vSeg');//36
            $table->decimal('vDesc');//37
            $table->decimal('vII');//38
            $table->decimal('vIPI');//39
            $table->decimal('vIPIDevol');//40
            $table->decimal('vPIS');//41
            $table->decimal('vCOFINS');//42
            $table->decimal('vOutro');//43
            $table->decimal('vNF');//44
            $table->decimal('vTotTrib');//45
            $table->decimal('vOrig');//46
            $table->decimal('vLiq');//47
            $table->integer('status_nota');//48
            $table->string('finalizado');//49
            $table->timestamps();
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
