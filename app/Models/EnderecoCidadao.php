<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoCidadao extends Model
{
    //
    protected $fillable = [
        'estado',
        'cidade',
        'bairro',
        'rua',
        'pessoa_id'
    ];

    public function Pessoa()
    {
        return $this->hasMany(Pessoa::class);
    }
}
