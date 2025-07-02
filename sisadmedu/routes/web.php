<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;

// Página pública
Route::get('/sisadmedu', function () {
    return view('sitioweb.inicio');
});

// Ruta protegida para el dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// CRUD de usuarios protegido
Route::resource('usuarios', UsuarioController::class)->middleware('auth');
