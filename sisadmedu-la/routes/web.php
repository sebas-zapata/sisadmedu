<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
| Aquí se registran todas las rutas que responden a peticiones web.
| Estas rutas utilizan el middleware "web" y son gestionadas por el
| RouteServiceProvider dentro del grupo "routes/web.php".
*/

/*
|--------------------------------------------------------------------------
| Ruta raíz - Redirección al login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| Módulo: Usuarios (Protegido por autenticación)
|--------------------------------------------------------------------------
| Rutas RESTful para la gestión de usuarios.
| Estas rutas están protegidas por autenticación (middleware 'auth').
*/
Route::middleware('auth')->group(function () {
    Route::resource('usuarios', UsuarioController::class)->names([
        'index'   => 'usuarios.index',
        'create'  => 'usuarios.create',
        'store'   => 'usuarios.store',
        'show'    => 'usuarios.show',
        'edit'    => 'usuarios.edit',
        'update'  => 'usuarios.update',
        'destroy' => 'usuarios.destroy',
    ]);
});

/*
|--------------------------------------------------------------------------
| Módulo: Dashboard
|--------------------------------------------------------------------------
| Ruta protegida por middleware de autenticación y verificación.
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Módulo: Perfil de Usuario
|--------------------------------------------------------------------------
| Rutas protegidas con middleware 'auth'.
| Permite editar, actualizar y eliminar el perfil del usuario autenticado.
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.delete');
});

require __DIR__.'/auth.php';
