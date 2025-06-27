<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('usuarios', UsuarioController::class);
