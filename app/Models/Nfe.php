<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfe extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_nfe', 'id_status', 'cUF', 'cNF', 'natOp', 'indPag', 'modelo', 'serie', 'nNF',
        'dhEmi', 'dhSaiEnt', 'tpNF', 'idDest', 'cMunFG', 'tpImp', 'tpEmis', 'cDV', 'tpAmb',
        'finNFe', 'indFinal', 'indPres', 'procEmi', 'verProc', 'dhCont', 'xJust', 'vBC',
        'vICMS', 'vICMSDeson', 'vFCP', 'vBCST', 'vST', 'vFCPST', 'vFCPSTRet', 'vProd',
        'vFrete', 'vSeg', 'vDesc', 'vII', 'vIPI', 'vIPIDevol', 'vPIS', 'vCOFINS', 'vOutro',
        'vNF', 'vTotTrib', 'vOrig', 'vLiq', 'status_nota', 'status_nota', 'finalizado'
    ];

    public function status(){
        return $this->hasOne(Nfestatus::class, 'id_status');
    }
}
