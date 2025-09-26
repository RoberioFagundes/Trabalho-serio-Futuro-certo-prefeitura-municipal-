<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    //
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'cartao_sus',
        'telefone',
        'user_id'
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    // Relacionamento: Pessoa tem um endereço
    public function endereco_cidadaos()
    {
        return $this->hasOne(EnderecoCidadao::class, 'pessoa_id'); 
        // 'pessoa_id' é a FK na tabela enderecos
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
