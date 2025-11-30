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
use App\Http\Controllers\PdfController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Middleware\RoleMiddleware;

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
Route::get('/sisadmedu', [SitioWebController::class, 'index'])->name('inicio');

Route::resource('usuarios', UsuarioController::class)
    ->middleware(['auth', 'rol:Administrador']);

// Modulo de Docentes protegido por autenticación
Route::resource('docentes', DocenteController::class)->middleware('auth');

// Modulo de Grados protegido por autenticación
Route::resource('grados', GradoController::class)->middleware(['auth', 'rol:Administrador']);

// Modulo de Estudiantes protegido por autenticación
Route::resource('estudiantes', EstudianteController::class)->middleware(['auth', 'rol:Administrador']);

// Rutas para cambiar la contraseña, protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/cambiar-contraseña', [LoginController::class, 'formCambiarContrasena'])->name('cambiar_contraseña');
    Route::post('/cambiar-contraseña', [LoginController::class, 'actualizarContrasena'])->name('actualizar_contraseña');
});

// Ruta para generar el PDF de usuarios
Route::get('/usuarios-pdf', [PdfController::class, 'usuarioPdf'])->name('usuarios.pdf')->middleware('auth');

// Ruta para generar el PDF de constancias
Route::get('/estudiantes/{id}/constancia', [PdfController::class, 'constancia'])
    ->name('pdf.constancia');

// Ruta para el dashboard con gráficos    
Route::get('/', [GraficosController::class, 'index'])
    ->name('dashboard')->middleware('auth');

// Ruta para buscar acudientes 
Route::get('/buscar-acudientes', [UsuarioController::class, 'buscarAcudientes'])
    ->name('acudientes.search')->middleware('auth');

//Ruta para obcervaciones
Route::post('/docentes/observaciones', [ObservacionController::class, 'store'])->name('observacion.store')->middleware('auth');
Route::delete('/docentes/observaciones/{id}', [ObservacionController::class, 'destroy'])->name('observacion.delete')->middleware('auth');

// Ruta para que los estudiantes consulten sus observaciones
Route::get('/estudiante/observaciones', [ObservacionController::class, 'misObservaciones'])
    ->name('estudiante.observaciones')->middleware('auth');

// Rutas para gestionar materias
Route::resource('materias', MateriaController::class)->middleware('auth');

// Rutas para gestionar horarios
Route::resource('horarios', HorarioController::class)->middleware('auth');

// Ruta para ver el horario del estudiante (un estudiante en especifico)
Route::get('/mi-horario', [HorarioController::class, 'show'])->name('estudiante.horario')->middleware('auth');

// Rutas para gestionar asignaciones
Route::resource('asignaciones', AsignacionController::class)->middleware('auth');

// Ruta para ver la informacion de un estudiante
Route::get('/estudiante/informacion', [EstudianteController::class, 'miInformacion'])->middleware(['auth', 'rol:Estudiante'])->name('estudiante.informacion');

// Ruta para ver la informacion de un docente
Route::get('/docente/informacion', [DocenteController::class, 'verInformacion'])->middleware(['auth', 'rol:Docente'])->name('docente.informacion');

// Ruta para ver los grados asigandos para un docente y ver los estudiantes asignados a ese grupo
Route::get('/docente/estudiante', [DocenteController::class, 'verEstudiantes'])->middleware(['auth', 'rol:Docente'])->name('docente.estudiantes');

// Ruta para que un docente vea un usuario especifico
Route::get('/docente/estudiante/{id}', [EstudianteController::class, 'show'])->middleware(['auth', 'rol:Docente'])->name('docente.estudiante');

// Ruta para ver las asignaturas para cada docente
Route::get('/docente/asignaturas', [DocenteController::class, 'verAsignaturas'])->middleware(['auth', 'rol:Docente'])->name('docente.asignaturas');

// Rutas de asistencias
Route::middleware(['auth'])->group(function () {
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/asistencias/crear/{asignacion}', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/asistencias/{id}/editar', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
    Route::put('/asistencias/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');
    Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy'])->name('asistencias.destroy');
    Route::get('/asistencias/asignacion/{id}', [AsistenciaController::class, 'porAsignacion'])
        ->name('asistencias.porAsignacion');
    // Reporte mensual (vista)
    Route::get('/asistencias/{asignacion}/reporte-mensual', [AsistenciaController::class, 'reporteMensual'])->name('asistencias.reporteMensual');
    // Generar PDF del reporte mensual
    Route::get('/asistencias/{asignacion}/reporte-mensual/pdf', [PdfController::class, 'generarReporteMensualPdf'])->name('asistencias.reporteMensual.pdf');
});
