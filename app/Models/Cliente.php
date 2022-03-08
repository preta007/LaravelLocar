<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'telefone_contato',
        'telefone_referencia',
        'nome_referencia',
        'score',
        'renda',
        'data_nasc',
        'email',
        'dossie'
    ];

    public function contrato()
    {
        return $this->belongsToMany(contrato::class, 'coinquilinos', 'id_cliente', 'id_contrato');
    }


}
