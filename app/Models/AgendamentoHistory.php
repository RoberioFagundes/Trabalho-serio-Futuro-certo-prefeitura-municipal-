<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendamentoHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'agendamento_id',  // referência ao agendamento
        'nova_data',       // nova data remarcada
        'nova_hora',       // nova hora remarcada
        'motivo',          // motivo da remarcação
        'user_id'          // usuário que realizou a remarcação
    ];

    // Relacionamento inverso para o agendamento
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    // Relacionamento para o usuário que fez a remarcação
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
