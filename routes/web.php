<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanoEstrategicoController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('planos', PlanoEstrategicoController::class);
