<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SitioWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilController;

// Rutas con el middleware de autenticación
Route::group(['middleware' => 'auth'], function () {
    // Rutas para el perfil del usuario autenticado
    Route::get('/perfil/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
});

// Rutas para el Login y logout del sistema
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Ruta para el sitio web
Route::get('/sisadmedu', [SitioWebController::class, 'index'])->name('sitio.inicio');

// Modulo de Usuarios protegido por autenticación
Route::resource('usuarios', UsuarioController::class)->middleware('auth');