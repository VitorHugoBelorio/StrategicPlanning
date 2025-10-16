<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanoEstrategicoController;
use App\Http\Controllers\DiagnosticoEstrategicoController;
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
});

Route::middleware('auth')->group(function () {
    Route::get('/planos/{planoId}/diagnostico/create', [DiagnosticoEstrategicoController::class, 'create'])->name('diagnosticos.create');
    Route::post('/planos/{planoId}/diagnostico', [DiagnosticoEstrategicoController::class, 'store'])->name('diagnosticos.store');
    Route::get('/diagnostico/{id}/edit', [DiagnosticoEstrategicoController::class, 'edit'])->name('diagnosticos.edit');
    Route::put('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'update'])->name('diagnosticos.update');
    Route::get('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'show'])->name('diagnosticos.show');
    Route::delete('/diagnostico/{id}', [DiagnosticoEstrategicoController::class, 'destroy'])->name('diagnosticos.destroy');

});
