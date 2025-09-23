<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessarFilaJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        // Aqui vai o que você quer processar na fila
        \Log::info("Processando fila para usuário: " . $this->user->name);

        // Exemplo: enviar e-mail
        // Mail::to($this->user->email)->send(new BemVindoMail($this->user));
    }
}
