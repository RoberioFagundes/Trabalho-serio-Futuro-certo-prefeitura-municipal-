<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReAgendamento extends Model
{
    //
    protected $fillable = [
        'nova_data_hora',
        'motivo',
        'agendamento_id',
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
