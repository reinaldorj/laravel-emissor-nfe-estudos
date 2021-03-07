<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCfopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfops', function (Blueprint $table) {
            $table->bigIncrements('id_cfop');
            $table->string('codigo_cfop');
            $table->string('desc_cfop');
            $table->string('tipo');
            $table->timestamps();
        });

        DB::table('cfops')->insert([
                ['codigo_cfop' => '1101', 'desc_cfop' => 'Compra para industrialização', 'tipo' => ''],
                ['codigo_cfop' => '1102', 'desc_cfop' => 'Compra para comercialização', 'tipo' => ''],
                ['codigo_cfop' => '1111', 'desc_cfop' => 'Compra para industrialização de mercadoria recebid...', 'tipo' => ''],
                ['codigo_cfop' => '1113', 'desc_cfop' => 'Compra para comercialização, de mercadoria recebid...', 'tipo' => ''],
                ['codigo_cfop' => '1116', 'desc_cfop' => 'Compra para industrialização originada de encomend...', 'tipo' => ''],
                ['codigo_cfop' => '1117', 'desc_cfop' => 'Compra para comercialização originada de encomenda...', 'tipo' => ''],
                ['codigo_cfop' => '1118', 'desc_cfop' => 'Compra de mercadoria para comercialização pelo adq...', 'tipo' => ''],
                ['codigo_cfop' => '1120', 'desc_cfop' => 'Compra para industrialização, em venda à ordem, já...','tipo' => ''],
                ['codigo_cfop' => '1121', 'desc_cfop' => 'Compra para comercialização, em venda à ordem, já ...', 'tipo' => ''],
                ['codigo_cfop' => '1122', 'desc_cfop' => 'Compra para industrialização em que a mercadoria f...', 'tipo' => ''],
                ['codigo_cfop' => '1124', 'desc_cfop' => 'Industrialização efetuada por outra empresa', 'tipo' => ''],
                ['codigo_cfop' => '1125', 'desc_cfop' => 'Industrialização efetuada por outra empresa quando...', 'tipo' => ''],
                ['codigo_cfop' => '1126', 'desc_cfop' => 'Compra para utilização na prestação de serviço', 'tipo' => ''],
                ['codigo_cfop' => '1151', 'desc_cfop' => 'Transferência para industrialização', 'tipo' => ''],
                ['codigo_cfop' => '1152', 'desc_cfop' => 'Transferência para comercialização', 'tipo' => ''],
                ['codigo_cfop' => '1153', 'desc_cfop' => 'Transferência de energia elétrica para distribuiçã...', 'tipo' => ''],
                ['codigo_cfop' => '1154', 'desc_cfop' => 'Transferência para utilização na prestação de serv...', 'tipo' => ''],
                ['codigo_cfop' => '1201', 'desc_cfop' => 'Devolução de venda de produção do estabelecimento', 'tipo' => ''],
                ['codigo_cfop' => '1202', 'desc_cfop' => 'Devolução de venda de mercadoria adquirida ou rece...', 'tipo' => ''],
                ['codigo_cfop' => '1203', 'desc_cfop' => 'Devolução de venda de produção do estabelecimento,.', 'tipo' => ''],
                ['codigo_cfop' => '1204', 'desc_cfop' => 'Devolução de venda de mercadoria adquirida ou rece...', 'tipo' => ''],
                ['codigo_cfop' => '1205', 'desc_cfop' => 'Anulação de valor relativo à prestação de serviço ...', 'tipo' => ''],
                ['codigo_cfop' => '1206', 'desc_cfop' => 'Anulação de valor relativo à prestação de serviço ...', 'tipo' => ''],
                ['codigo_cfop' => '1207', 'desc_cfop' => 'Anulação de valor relativo à venda de energia elét...', 'tipo' => ''],
                ['codigo_cfop' => '1208', 'desc_cfop' => 'Devolução de produção do estabelecimento, remetida...', 'tipo' => ''],
                ['codigo_cfop' => '1209', 'desc_cfop' => 'Devolução de mercadoria adquirida ou recebida de t...', 'tipo' => ''],
                ['codigo_cfop' => '1251', 'desc_cfop' => 'Compra de energia elétrica para distribuição ou co...', 'tipo' => ''],
                ['codigo_cfop' => '1252', 'desc_cfop' => 'Compra de energia elétrica por estabelecimento ind...', 'tipo' => ''],
                ['codigo_cfop' => '1253', 'desc_cfop' => 'Compra de energia elétrica por estabelecimento com...', 'tipo' => ''],
                ['codigo_cfop' => '1254', 'desc_cfop' => 'Compra de energia elétrica por estabelecimento pre...', 'tipo' => ''],
                ['codigo_cfop' => '1255', 'desc_cfop' => 'Compra de energia elétrica por estabelecimento pre...', 'tipo' => ''],
                ['codigo_cfop' => '1256', 'desc_cfop' => 'Compra de energia elétrica por estabelecimento de ...', 'tipo' => ''],
                ['codigo_cfop' => '1257', 'desc_cfop' => 'Compra de energia elétrica para consumo por demand...', 'tipo' => ''],
                ['codigo_cfop' => '1301', 'desc_cfop' => 'Aquisição de serviço de comunicação para execução ...', 'tipo' => ''],
                ['codigo_cfop' => '1302', 'desc_cfop' => 'Aquisição de serviço de comunicação por estabeleci...', 'tipo' => ''],
                ['codigo_cfop' => '1303', 'desc_cfop' => 'Aquisição de serviço de comunicação por estabeleci...', 'tipo' => ''],
                ['codigo_cfop' => '1304', 'desc_cfop' => 'Aquisição de serviço de comunicação por estabeleci...', 'tipo' => ''],
                ['codigo_cfop' => '1305', 'desc_cfop' => 'Aquisição de serviço de comunicação por estabeleci...', 'tipo' => ''],
                ['codigo_cfop' => '1306', 'desc_cfop' => 'Aquisição de serviço de comunicação por estabeleci...', 'tipo' => ''],
                ['codigo_cfop' => '1351', 'desc_cfop' => 'Aquisição de serviço de transporte para execução d...', 'tipo' => ''],
                ['codigo_cfop' => '1352', 'desc_cfop' => 'Aquisição de serviço de transporte por estabelecim...', 'tipo' => ''],
                ['codigo_cfop' => '1353', 'desc_cfop' => 'Aquisição de serviço de transporte por estabelecim...', 'tipo' => ''],
                ['codigo_cfop' => '1354', 'desc_cfop' => 'Aquisição de serviço de transporte por estabelecim...', 'tipo' => ''],
                ['codigo_cfop' => '1355', 'desc_cfop' => 'Aquisição de serviço de transporte por estabelecim...', 'tipo' => ''],
                ['codigo_cfop' => '1356', 'desc_cfop' => 'Aquisição de serviço de transporte por estabelecim...', 'tipo' => ''],
                ['codigo_cfop' => '1401', 'desc_cfop' => 'Compra para industrialização em operação com merca...', 'tipo' => ''],
                ['codigo_cfop' => '1403', 'desc_cfop' => 'Compra para comercialização em operação com mercad...', 'tipo' => ''],
                ['codigo_cfop' => '1406', 'desc_cfop' => 'Compra de bem para o ativo imobilizado cuja mercad...', 'tipo' => ''],
                ['codigo_cfop' => '1407', 'desc_cfop' => 'Compra de mercadoria para uso ou consumo cuja merc...', 'tipo' => ''],
                ['codigo_cfop' => '1408', 'desc_cfop' => 'Transferência para industrialização em operação co...', 'tipo' => ''],
                ['codigo_cfop' => '1409', 'desc_cfop' => 'Transferência para comercialização em operação com...', 'tipo' => ''],
                ['codigo_cfop' => '1410', 'desc_cfop' => 'Devolução de venda de produção do estabelecimento ...', 'tipo' => ''],
                ['codigo_cfop' => '1411', 'desc_cfop' => 'Devolução de venda de mercadoria adquirida ou rece...', 'tipo' => ''],
                ['codigo_cfop' => '1414', 'desc_cfop' => 'Retorno de produção do estabelecimento, remetida p...', 'tipo' => ''],
                ['codigo_cfop' => '1415', 'desc_cfop' => 'Retorno de mercadoria adquirida ou recebida de ter...', 'tipo' => ''],
                ['codigo_cfop' => '1451', 'desc_cfop' => 'Retorno de animal do estabelecimento produtor', 'tipo' => ''],
                ['codigo_cfop' => '1452', 'desc_cfop' => 'Retorno de insumo não utilizado na produção', 'tipo' => ''],
                ['codigo_cfop' => '1501', 'desc_cfop' => 'Entrada de mercadoria recebida com fim específico ...', 'tipo' => ''],
                ['codigo_cfop' => '1503', 'desc_cfop' => 'Entrada decorrente de devolução de produto remetid...', 'tipo' => ''],
                ['codigo_cfop' => '1504', 'desc_cfop' => 'Entrada decorrente de devolução de mercadoria reme...', 'tipo' => ''],
                ['codigo_cfop' => '1551', 'desc_cfop' => 'Compra de bem para o ativo imobilizado', 'tipo' => ''],
                ['codigo_cfop' => '1552', 'desc_cfop' => 'Transferência de bem do ativo imobilizado', 'tipo' => ''],
                ['codigo_cfop' => '1553', 'desc_cfop' => 'Devolução de venda de bem do ativo imobilizado', 'tipo' => ''],
                ['codigo_cfop' => '1554', 'desc_cfop' => 'Retorno de bem do ativo imobilizado remetido para ...', 'tipo' => ''],
                ['codigo_cfop' => '1555', 'desc_cfop' => 'Entrada de bem do ativo imobilizado de terceiro, r...', 'tipo' => ''],//parei na 65

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfops');
    }
}
