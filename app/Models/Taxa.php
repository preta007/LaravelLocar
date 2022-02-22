<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxa extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'comissao',
        'parcelas',
        'ativo',
        'created_by'
    ];


    public function toggleTaxaActivation()
    {
        $this->ativo = !$this->ativo;
        $this->save();
        return $this->ativo;
    }
}
