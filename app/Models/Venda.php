<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    //use HasFactory;
    protected $fillable =
    [
        'id_venda', 'id_cliente', 'data_venda', 'hora_venda', 'total', 'finalizado'
    ];

    public function search($filter = null)
    {
        $results =  $this->whereHas('cliente', function ($query) use ($filter) {
                $query->where('clientes.nome', 'like', '%' . @$filter['filter'] . '%');
            });
        return $results;
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function itens(){
        return $this->hasMany(ItemVenda::class, 'id_venda', 'id_venda');
    }

    public function getitens($id_venda){
        return $this->join('item_vendas', 'item_vendas.id_venda', '=', 'vendas.id_venda')
        ->join('produtos', 'item_vendas.id_produto', '=', 'produtos.id_produto')
        ->join('unidades', 'produtos.id_unidade', '=', 'unidades.id_unidade')
        ->select('vendas.*', 'item_vendas.*', 'produtos.*', 'unidades.*')->where('item_vendas.id_venda', $id_venda)->get();
    }
}
