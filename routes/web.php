<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AgendamentoEmailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\FilaController;
use App\Http\Controllers\PessoaAtendidaController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ReAgendamentoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SecretariaController;
use App\Models\Atendimento;

// ROTA PÚBLICA
Route::get('/', function () {
    return view('welcome');
});

// ROTAS DO GRÁFICO (JSON para AJAX)
Route::middleware('auth')->group(function() {
    Route::get('/grafico/dados', function() {
        $dados = Atendimento::selectRaw('DAYOFWEEK(created_at) as dia_semana, COUNT(*) as total')
            ->groupBy('dia_semana')
            ->orderBy('dia_semana')
            ->get();

        $dias = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];
        $labels = [];
        $totais = [];

        foreach ($dados as $d) {
            $labels[] = $dias[$d->dia_semana - 1];
            $totais[] = $d->total;
        }

        return response()->json([
            'labels' => $labels,
            'totais' => $totais
        ]);
    })->name('grafico.dados');

    Route::get('/grafico', function() {
        return view('grafico');
    })->name('grafico');

    Route::get('/grafico/pessoas-atendidas', function () {
        $dados = Atendimento::selectRaw('DAYOFWEEK(data_hora) as dia_semana, COUNT(*) as total')
            ->groupBy('dia_semana')
            ->orderBy('dia_semana')
            ->get();

        $dias = ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'];
        $labels = [];
        $totais = [];

        foreach ($dados as $d) {
            $labels[] = $dias[$d->dia_semana - 1];
            $totais[] = $d->total;
        }

        return response()->json([
            'labels' => $labels,
            'totais' => $totais
        ]);
    })->name('grafico.pessoas-atendidas');
});

// DASHBOARD COM VERIFICAÇÃO DE LOGIN E TIPO DE USUÁRIO
Route::get('/dashboard', function (Request $request) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return match (Auth::user()->tipo_usuario) {
        'user'       => view('cidadao.dashboard'),
        'gestor'     => view('prefeito.dashboard_prefeito'),
        'cidadao'    => view('dashboard.plano_basico.pagamentoAprovado'),
        'secretaria' => view('secretaria.dashboardSecretaria'),
        'adm'        => view('dashboard.plano_medio.pagamentoAprovado'),
        default      => abort(403, 'Tipo de usuário não autorizado.'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// LOGOUT
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ROTAS PROTEGIDAS POR LOGIN
Route::middleware('auth')->group(function () {

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // RECURSOS
    Route::resources([
        'admins'          => AdminController::class,
        'agendamentos'    => AgendamentoController::class,
        'atendimentos'    => AtendimentoController::class,
        'filas'           => FilaController::class,
        'pessoaatendidas' => PessoaAtendidaController::class,
        'pessoas'         => PessoaController::class,
        'reagendamentos'  => ReAgendamentoController::class,
    ]);

    // PDF
    Route::get('/protocolo/{id}/pdf', [PDFController::class, 'gerar'])->name('protocolo.pdf');

    // para agendar pessoas que já estão cadastrada no sistema 
    Route::get('/agendamentos/novo/{pessoa}', [AgendamentoController::class, 'create_pessoas_cadastradas'])->name('agendamentos.create.pessoas.cadastradas');
    Route::post('/agendamentos/pessoas/cadastradas', [AgendamentoController::class, 'store_pessoas_cadastradas'])->name('agendamentos.store_pessoas_cadastradas');

    // FILA
    Route::post('/fila/{fila}/confirmar', [FilaController::class, 'confirmarAtendimento'])->name('filas.confirmar');
    Route::get('/adicionando-fila/{id}', [AgendamentoController::class, 'adicionandoFila'])->name('adicionando-fila');

    // AGENDAMENTO - ROTAS EXTRAS
    Route::delete('/remover-agendamento/{id}', [AgendamentoController::class, 'delete'])->name('agendamentos.delete');
    Route::delete('/remarcacao/apagada/{id}', [AgendamentoController::class, 'remarcacaoDestoy'])->name('remarcacao.delete');
    Route::post('/remarcacao', [AgendamentoController::class, 'remarcacaoStory'])->name('remarcacao-story');
    Route::get('/remarcacao', [AgendamentoController::class, 'remarcacao'])->name('marcacao.index');
    Route::get('/remarcacao-edit/{id}', [AgendamentoController::class, 'remarcacao_edit'])->name('remarcacao-edit');
    Route::put('/remarcacao-update', [AgendamentoController::class, 'remarcacao_update'])->name('remarcacao.update');

});

require __DIR__ . '/auth.php';
