<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'data_nascimento' => 'datetime'
    ];

    public function planos() {
        return $this->belongsToMany('App\Models\Plano', 'cliente_plano')->as('planos_cliente');
    }
}
