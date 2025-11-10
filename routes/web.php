<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanoEstrategicoController;
use App\Http\Controllers\DiagnosticoEstrategicoController;
use App\Http\Controllers\ObjetivoEstrategicoController;
use App\Http\Controllers\PilarEstrategicoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\IndicadorDesempenhoController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

// Login principal acessível diretamente em "/"
Route::get('/', [AuthController::class, 'index'])->name('login');

// Tentativa de login
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (somente usuários autenticados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Redireciona para os planos após login
    Route::get('/dashboard', function () {
        return redirect()->route('planos.index');
    })->name('dashboard');

    // CRUD dos planos estratégicos
    Route::resource('planos', PlanoEstrategicoController::class);

    /*
    |--------------------------------------------------------------------------
    | Diagnóstico Estratégico
    |--------------------------------------------------------------------------
    */
    Route::get('/planos/{planoId}/diagnostico/create', [DiagnosticoEstrategicoController::class, 'create'])->name('diagnosticos.create');
    Route::post('/planos/{planoId}/diagnostico', [DiagnosticoEstrategicoController::class, 'store'])->name('diagnosticos.store');
    Route::get('/diagnostico/{id}/edit', [DiagnosticoEstrategicoController::class, 'edit'])->name('diagnosticos.edit');
    Route::put('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'update'])->name('diagnosticos.update');
    Route::get('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'show'])->name('diagnosticos.show');
    Route::delete('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'destroy'])->name('diagnosticos.destroy');

    /*
    |--------------------------------------------------------------------------
    | Objetivos Estratégicos
    |--------------------------------------------------------------------------
    */
    Route::get('/planos/{planoId}/objetivos/create', [ObjetivoEstrategicoController::class, 'create'])->name('objetivos.create');
    Route::post('/planos/{planoId}/objetivos', [ObjetivoEstrategicoController::class, 'store'])->name('objetivos.store');
    Route::get('/objetivos/{id}/edit', [ObjetivoEstrategicoController::class, 'edit'])->name('objetivos.edit');
    Route::put('/objetivos/{id}', [ObjetivoEstrategicoController::class, 'update'])->name('objetivos.update');
    Route::delete('/objetivos/{id}', [ObjetivoEstrategicoController::class, 'destroy'])->name('objetivos.destroy');

    /*
    |--------------------------------------------------------------------------
    | Pilares Estratégicos (Trilhas)
    |--------------------------------------------------------------------------
    */
    Route::get('/planos/{planoId}/pilares', [PilarEstrategicoController::class, 'index'])->name('pilares.index');
    Route::get('/planos/{planoId}/pilares/create', [PilarEstrategicoController::class, 'create'])->name('pilares.create');
    Route::post('/planos/{planoId}/pilares', [PilarEstrategicoController::class, 'store'])->name('pilares.store');
    Route::get('/pilares/{id}', [PilarEstrategicoController::class, 'show'])->name('pilares.show');
    Route::get('/pilares/{id}/edit', [PilarEstrategicoController::class, 'edit'])->name('pilares.edit');
    Route::put('/pilares/{id}', [PilarEstrategicoController::class, 'update'])->name('pilares.update');
    Route::delete('/pilares/{id}', [PilarEstrategicoController::class, 'destroy'])->name('pilares.destroy');
    Route::get('/pilares/{id}/relatorio', [PilarEstrategicoController::class, 'relatorioProgresso'])->name('pilares.relatorio');

    /*
    |--------------------------------------------------------------------------
    | Tasks das Trilhas
    |--------------------------------------------------------------------------
    */
    Route::get('/pilares/{pilarId}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/pilares/{pilarId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/pilares/{pilarId}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');

    /*
    |--------------------------------------------------------------------------
    | Indicadores / Painel de Desempenho
    |--------------------------------------------------------------------------
    */
    Route::get('/planos/{planoId}/indicadores/painel', [IndicadorDesempenhoController::class, 'painel'])
        ->name('indicadores.painel');
    Route::get('/planos/{planoId}/indicadores/chart', [IndicadorDesempenhoController::class, 'chartData'])
        ->name('indicadores.chart');
});
