<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    public function clientes() {
        return $this->belongsToMany('App\Models\Cliente', 'cliente_plano')->as('clientes_plano');;
    }
}
