<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    //
    protected $fillable = [
        'data_hora_inicio',
        'data_hora_fim',
        'fila_id',
        'user_id',
    ];

    public function fila()
    {
        return $this->belongsTo(Fila::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
