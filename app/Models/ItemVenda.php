<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $fillable = [
        'id_produto','id_venda', 'id_cliente', 'qtde', 'valor'
    ];

    public function venda() {
        return $this->hasOne(Cliente::class, 'id_venda', 'id_venda');
    }

    public function produto() {
        return $this->hasOne(Produto::class, 'id_produto', 'id_produto');
    }
}
