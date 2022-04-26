<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    protected $fillable = [
        'id',
        'tipo_imovel',
        'cep',
        'rua',
        'numero',
        'cidade',
        'estado',
        'bairro',
        'status',
        'complemento',
        'valor_locaticio',
        'valor_plano',
        'tempo',
        'id_plano',
        'id_taxa',
        'id_cliente',
        'id_user',
        'data_pagamento',
        'email' 
    ];


    public function plano()
    {
        return $this->belongsTo(Plano::class,'id_plano');
    }

    public function taxa()
    {
        return $this->belongsTo(Taxa::class,'id_taxa');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function coinquilino()
    {
        return $this->belongsToMany(Cliente::class, 'coinquilinos', 'id_contrato', 'id_cliente');
    }


}
