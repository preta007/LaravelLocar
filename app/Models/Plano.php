<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    protected $fillable = [
        'nome',
        'percentual',
        'limite',
        'ativo',
        'created_by'
    ];


    public function togglePlanoActivation()
    {
        $this->ativo = !$this->ativo;
        $this->save();
        return $this->ativo;
    }
}
