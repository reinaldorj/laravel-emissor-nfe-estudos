<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cfop extends Model
{
    //use HasFactory;
    protected $fillable = ['codigo_cfop', 'desc_cfop', 'tipo'];
}
