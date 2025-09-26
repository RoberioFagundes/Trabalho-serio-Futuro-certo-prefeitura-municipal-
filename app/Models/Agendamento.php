<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    //
    protected $guarded = [];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

       /**
     * Relacionamento: um agendamento pertence a uma fila
     */
    public function fila()
    {
        return $this->belongsTo(Fila::class);
    }

    /**
     * Relacionamento: um agendamento possui vários históricos de remarcação
     */
   

     // Relacionamento com o histórico de remarcações
    public function historicos()
    {
        return $this->hasMany(AgendamentoHistory::class);
    }

}
