<?php

use Illuminate\Support\Facades\Route;   
use Illuminate\Support\Facades\Auth;
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

use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function (Request $request) {

    //comparando se na tabela user tem coluna role verificando de existe um registro do tipo admin
    if((auth()->user()->tipo_usuario == "user")){
	
		// $cliente_id={{ session('cliente_id') }};
		// dd($cliente_id);

		// Blog::latest()->limit(5)->get();
	  
        return view('cidadao.dashboard');

    }

    
	if ((auth()->user()->tipo_usuario == "gestor")) {

	
		return view('prefeito.dashboard_prefeito');

	}

     //comparando se na tabela user tem coluna role verificando de existe um registro do tipo aluno
     if((auth()->user()->tipo_usuario == "cidadao")){

        return view('dashboard.plano_basico.pagamentoAprovado');

    }

      //comparando se na tabela user tem coluna role verificando de existe um registro do tipo aluno
     if((auth()->user()->tipo_usuario == "secretaria")){

        return view('secretaria.dashboardSecretaria');

    }

     //comparando se na tabela user tem coluna role verificando de existe um registro do tipo professor
     if(auth()->user()->tipo_usuario == "adm"){
		
        return view('dashboard.plano_medio.pagamentoAprovado');

    }

     
   
})->middleware(['auth', 'verified'])->middleware(['auth'])->name('dashboard');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])          
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
  
    Route::resource('admins', AdminController::class)->names('admins');



    Route::resource('agendamentos', AgendamentoController::class)->names('agendamentos');
    Route::resource('atendimentos', AtendimentoController::class)->names('atendimentos');
    Route::resource('filas', FilaController::class)->names('filas');
    Route::resource('pessoaatendidas', PessoaAtendidaController::class)->names('pessoaatendidas');
    Route::resource('pessoas', PessoaController::class)->names('pessoas');
    Route::resource('reagendamentos', ReAgendamentoController::class)->names('reagendamentos');
    Route::get('/protocolo/{id}/pdf', [PDFController::class, 'gerar'])->name('protocolo.pdf');
    
    Route::get('/adicionando-fila/{id}', [AgendamentoController::class, 'adicionandoFila'])->middleware(['auth'])->name('adicionando-fila');
    
});

require __DIR__.'/auth.php';
