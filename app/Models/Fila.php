<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fila extends Model
{
    //
    protected $fillable = [
        'nome',
        'descricao',
        'agendamento_id'
    ];

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
