<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nfedestinatario extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_nfe', 'dest_xNome', 'dest_IE', 'dest_indIEDest', 'dest_ISUF', 'dest_IM', 'dest_email',
        'dest_CNPJ', 'dest_CPF', 'dest_idEstrangeiro', 'dest_xLgr', 'dest_nro', 'dest_xCpl',
        'dest_xBairro', 'dest_cMun', 'dest_xMun', 'dest_UF', 'dest_CEP', 'dest_cPais', 
        'dest_xPais', 'dest_fone'
    ];

    public function nfe(){
        return $this->hasOne(Nfe::class, 'id_nfe');
    }
}
