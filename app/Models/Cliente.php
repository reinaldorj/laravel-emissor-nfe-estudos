<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //use HasFactory;
    protected $fillable = [
        'nome', 'nome_fantasia', 'cpf', 'cnpj', 'fone', 'celular', 'email', 'cep', 'logradouro',
        'numero', 'uf', 'cidade', 'complemento', 'bairro', 'ie', 'im', 'rg', 'suframa',
        'cod_estrangeiro', 'ie_subt_trib', 'indIEDest', 'ibge'
    ];

    public function search($filter = null)
    {
        $results =  $this
            ->where('nome', 'LIKE', "%{$filter}%")
            ->orWhere('nome_fantasia', 'LIKE', "%{$filter}%")
            ->paginate(10);
        return $results;
    }
}
