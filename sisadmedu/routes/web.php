<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SitioWebController;
use App\Http\Controllers\DashboardController;

// Login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Ruta para el sitio web
Route::get('/sisadmedu', [SitioWebController::class, 'index'])->name('sitio.inicio');

// CRUD de usuarios protegido
Route::resource('usuarios', UsuarioController::class)->middleware('auth');
