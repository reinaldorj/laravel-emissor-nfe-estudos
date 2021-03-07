<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emitente extends Model
{
    //use HasFactory;
    protected $fillable = [
        'razao_social', 'nome_fantasia', 'cnpj', 'ie', 'iest', 'im', 'fone',
        'email', 'email_contabilidade', 'cep', 'logradouro', 'complemento',
        'numero', 'uf', 'cidade', 'bairro', 'cnae', 'regime_tributario', 'ibge'
    ];

    public function search($filter = null)
    {
        $results =  $this
            ->where('razao_social', 'LIKE', "%{$filter}%")
            ->orWhere('nome_fantasia', 'LIKE', "%{$filter}%")
            ->paginate(10);
        return $results;
    }
}
