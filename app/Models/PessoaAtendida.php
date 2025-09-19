<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaAtendida extends Model
{
    //
    protected $fillable = [
        'atendimento_id',
        'quantidade_pessoas',
        'valor_atendido',
    ];
    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class);
    }

    
}
