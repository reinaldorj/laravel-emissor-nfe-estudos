<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfeitem extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_produto', 'id_venda', 'id_nfe', 'numero_item', 'cProd', 'cEAN',
        'xProd', 'NCM', 'cBenef', 'NVE', 'EXTIPI', 'CFOP', 'uCom',
        'qCom', 'vUnCom', 'vProd', 'cEANTrib', 'uTrib', 'qTrib', 
        'vUnTrib', 'vFrete', 'vSeg', 'vDesc', 'vOutro', 'indTot',
        'xPed', 'nItemPed', 'nFCI'
    ];

    public function produto(){
        return $this->hasOne(Produto::class, 'id_produto');
    }

    public function nfe(){
        return $this->hasOne(Nfe::class, 'id_nfe');
    }

    public function venda(){
        return $this->belongsTo(Venda::class, 'id_venda', 'id_venda');
    }
}
