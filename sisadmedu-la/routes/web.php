<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/sisadmedu', function () {
    return view('sitioweb.inicio');
});

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('usuarios', UsuarioController::class);
