<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfe extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_nfe', 'id_venda','id_status', 'cUF', 'cNF', 'natOp', 'indPag', 'modelo', 'serie', 'nNF',
        'dhEmi', 'dhSaiEnt', 'tpNF', 'idDest', 'cMunFG', 'tpImp', 'tpEmis', 'cDV', 'tpAmb',
        'finNFe', 'indFinal', 'indPres', 'procEmi', 'verProc', 'dhCont', 'xJust', 'vBC',
        'vICMS', 'vICMSDeson', 'vFCP', 'vBCST', 'vST', 'vFCPST', 'vFCPSTRet', 'vProd',
        'vFrete', 'vSeg', 'vDesc', 'vII', 'vIPI', 'vIPIDevol', 'vPIS', 'vCOFINS', 'vOutro',
        'vNF', 'vTotTrib', 'vOrig', 'vLiq', 'status_nota', 'status_nota', 'finalizado'
    ];

    public function status(){
        return $this->hasOne(Nfestatus::class, 'id_status', 'id_status');
    }

    public function vendas(){
        return $this->hasOne(Venda::class, 'id_venda', 'id_venda');
    }

    public function getnfes(){
        return $this->join('vendas', 'nves.id_venda', '=', 'vendas.id_venda')
        ->join('clientes', 'vendas.id_cliente', '=', 'clientes.id_cliente')
        ->join('nfestatuses', 'nves.id_status', '=', 'nfestatuses.id_status')
        ->select('clientes.*', 'vendas.*', 'nves.*', 'nfestatuses.*')->paginate();
    }
}
