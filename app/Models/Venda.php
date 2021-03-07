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
}
