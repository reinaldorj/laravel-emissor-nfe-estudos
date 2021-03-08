<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_unidade', 'produto', 'preco', 'cfop', 'gtin', 'ncm', 'cest', 'cbenef',
        'extipi', 'mva', 'nfci', 'sku', 'quantidade', 'largura', 'altura', 'comprimento',
        'peso', 'id_und_peso', 'id_und_medida'
    ];

    public function search($filter = null)
    {
        $results =  $this
            ->where('produto', 'LIKE', "%{$filter}%")
            /*->orWhere('description', 'LIKE', "%{$filter}%")*/
            ->paginate(10);
        return $results;
    }

    public function unidade() {
        return $this->hasOne(Unidade::class, 'id_unidade', 'id_unidade');
    }
}
