<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfeemitente extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_nfe','em_xNome', 'em_xFant', 'em_IE', 'em_IEST', 'em_IM', 'em_CNAE', 'em_CRT',
        'em_CNPJ', 'em_CPF', 'em_xLgr', 'em_nro', 'em_xCpl', 'em_xBairro', 'em_cMun',
        'em_xMun', 'em_UF', 'em_CEP', 'em_cPais', 'em_xPais', 'em_fone', 'em_EMAIL',
        'em_SUFRAMA'
    ];
}
