<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //use HasFactory;
    protected $fillable = [
        'nome_estado', 'uf_estado', 'codigo_estado'
    ];
}
