<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    //
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'user_id'
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
