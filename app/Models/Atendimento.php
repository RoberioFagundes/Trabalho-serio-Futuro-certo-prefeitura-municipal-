<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    //
    protected $guarded = [
    
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
