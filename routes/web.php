<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanoEstrategicoController;

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
