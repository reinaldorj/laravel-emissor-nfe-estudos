<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    //use HasFactory;
    protected $fillable = [
        'layout',
        'nfe_serie',
        'tipo_nota_padrao',
        'nfe_ambiente',
        'nfe_versao',
        'empresa_padrao',
        'ultimanfe',
        'natureza_padrao',
        'indFinal',
        'tipo_frete',
        'certificado_digital',
        'senha'
    ];

    public function emitente()
    {
        return $this->hasOne(Emitente::class, 'id_emitente', 'empresa_padrao');
    }
}
