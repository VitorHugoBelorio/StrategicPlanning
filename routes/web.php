<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanoEstrategicoController;
use App\Http\Controllers\DiagnosticoEstrategicoController;
use App\Http\Controllers\ObjetivoEstrategicoController;
use App\Http\Controllers\PilarEstrategicoController;

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
    | Pilares Estratégicos
    |--------------------------------------------------------------------------
    */
    Route::get('/planos/{planoId}/pilares', [PilarEstrategicoController::class, 'index'])->name('pilares.index');
    Route::get('/planos/{planoId}/pilares/create', [PilarEstrategicoController::class, 'create'])->name('pilares.create');
    Route::post('/planos/{planoId}/pilares', [PilarEstrategicoController::class, 'store'])->name('pilares.store');
    Route::get('/pilares/{id}', [PilarEstrategicoController::class, 'show'])->name('pilares.show');
    Route::get('/pilares/{id}/edit', [PilarEstrategicoController::class, 'edit'])->name('pilares.edit');
    Route::put('/pilares/{id}', [PilarEstrategicoController::class, 'update'])->name('pilares.update');
    Route::delete('/pilares/{id}', [PilarEstrategicoController::class, 'destroy'])->name('pilares.destroy');
});
