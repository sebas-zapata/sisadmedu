<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SitioWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ForgotPasswordController;


// Rutas con el middleware de autenticación
Route::group(['middleware' => 'auth'], function () {
    // Rutas para el perfil del usuario autenticado
    Route::get('/perfil/edit', [UsuarioController::class, 'editarPerfil'])->name('perfil.edit');
    Route::put('/perfil/update', [UsuarioController::class, 'actualizarPerfil'])->name('perfil.update');
});

// Rutas para el Login y logout del sistema
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Recuperación de contraseña
Route::get('/password/forgot', [ForgotPasswordController::class, 'showEmailForm'])->name('password.forgot');
Route::post('/password/send-code', [ForgotPasswordController::class, 'sendCode'])->name('password.send.code');

Route::get('/password/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify.form');
Route::post('/password/verify', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');

Route::get('/password/reset', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');


// Ruta dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Ruta para el sitio web
Route::get('/sisadmedu', [SitioWebController::class, 'index'])->name('sitio.inicio');

// Modulo de Usuarios protegido por autenticación
Route::resource('usuarios', UsuarioController::class)->middleware('auth');

// Modulo de Docentes protegido por autenticación
Route::resource('docentes', DocenteController::class)->middleware('auth');

// Modulo de Grados protegido por autenticación
Route::resource('grados', GradoController::class)->middleware('auth');

// Modulo de Estudiantes protegido por autenticación
Route::resource('estudiantes', EstudianteController::class)->middleware('auth');
