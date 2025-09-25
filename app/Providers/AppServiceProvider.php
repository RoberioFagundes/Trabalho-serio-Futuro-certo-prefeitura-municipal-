<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <- IMPORTANTE
use App\Models\Agendamento;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Variável global para todas as views
        View::share('nome_app', 'Dashboard Secretaria');

        // Exemplo: todos os agendamentos do dia
        $agendamentos_dia = Agendamento::with('pessoa')
            ->whereDate('data_hora', now())
            ->orderBy('data_hora')
            ->simplePaginate();

        View::share('agendamentos_dia', $agendamentos_dia);
    }
}
