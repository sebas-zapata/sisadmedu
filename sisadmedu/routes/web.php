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
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PeriodoController;

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
    ->middleware(['auth', 'rol:Administrador,Secretaria']);

// Modulo de Docentes protegido por autenticación
Route::resource('docentes', DocenteController::class)->middleware(['auth', 'rol:Docente,Administrador']);

// Modulo de Grados protegido por autenticación
Route::resource('grados', GradoController::class)->middleware(['auth', 'rol:Administrador']);

// Modulo de Estudiantes protegido por autenticación
Route::resource('estudiantes', EstudianteController::class)->middleware(['auth', 'rol:Administrador,Secretaria']);

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

// Ruta para consultar el certificado de estudio de un estudiante
Route::get('/estudiante/certificado/consultar', [PdfController::class, 'consultarEstudiante'])
    ->name('pdf.consultar')->middleware(['auth', 'rol:Estudiante']);

// Ruta para generar el certificado de estudio de un estudiante
Route::post('/estudiante/certificado', [PdfController::class, 'generarCertificado'])
    ->name('pdf.certificado');

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
    ->name('estudiante.observaciones')->middleware(['auth', 'rol:Estudiante']);

// Ruta para que los acudientes consulten las observaciones de los estudiantes
Route::get('/estudiante/observaciones/acudiente', [ObservacionController::class, 'acudienteObservacionesEstudiante'])
    ->name('acudiente.observaciones')->middleware(['auth', 'rol:Acudiente']);

// Rutas para gestionar materias
Route::resource('materias', MateriaController::class)->middleware(['auth', 'rol:Administrador']);

// Rutas para gestionar horarios
Route::resource('horarios', HorarioController::class)->middleware(['auth', 'rol:Administrador']);

// Ruta para ver el horario del estudiante (un estudiante en especifico)
Route::get('/mi-horario/estudiante', [HorarioController::class, 'show'])->name('estudiante.horario')->middleware(['auth', 'rol:Estudiante']);

// Rutas para gestionar asignaciones
Route::resource('asignaciones', AsignacionController::class)->middleware(['auth', 'rol:Administrador']);

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


Route::middleware(['auth'])->group(function () {

    // Listado general de asistencias del docente
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');

    // Tomar asistencia por asignación y fecha
    Route::get('/asistencias/asignacion/{id}', [AsistenciaController::class, 'porAsignacion'])->name('asistencias.porAsignacion');

    // Guardar asistencia (POST desde formulario porAsignacion)
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');

    // Editar asistencia individual
    Route::get('/asistencias/{id}/editar', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
    Route::put('/asistencias/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');

    // Eliminar asistencia individual
    Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy'])->name('asistencias.destroy');

    // Reporte mensual en vista HTML
    Route::get('/asistencias/{asignacion}/reporte-mensual', [AsistenciaController::class, 'reporteMensual'])->name('asistencias.reporteMensual');

    // Generar PDF del reporte mensual
    Route::get('/asistencias/{asignacion}/reporte-mensual/pdf', [PdfController::class, 'generarReporteMensualPdf'])->name('asistencias.reporteMensual.pdf');
});

    // Ruta para ver la informacion de un acudiente
Route::middleware(['auth', 'rol:Acudiente'])->group(function () {
    Route::get('/acudiente/informacion', [UsuarioController::class, 'acudienteInformacion'])
        ->name('acudiente.informacion');
});
    // Rutas gestion de notas -> guardar, editar leer y generar boletin de notas en formato PDF
Route::get('/notas/crear/{estudiante_id}/{asignacion_id}', [NotaController::class, 'create'])->name('notas.create')->middleware('auth', 'rol:Docente');
Route::post('/notas/guardar', [NotaController::class, 'store'])->name('notas.store')->middleware('auth', 'rol:Docente');
Route::get('/mis-notas', [NotaController::class, 'notasEstudiante'])->name('estudiante.notas')->middleware('auth', 'rol:Estudiante');
Route::get('/mis-notas/pdf', [NotaController::class, 'descargarBoletin'])->name('estudiante.boletin.pdf')->middleware('auth');

// Rutas para gestionar los periodos academicos
Route::get('periodos', [PeriodoController::class, 'index'])
    ->name('periodos.index')->middleware('auth', 'rol:Administrador');
Route::post('periodos/{id}/estado', [PeriodoController::class, 'cambiarEstado'])
    ->name('periodos.estado')->middleware('auth', 'rol:Administrador');

    // Ruta pata ver las notas de un estudiante siendo un acudiente
Route::get('/mis-notas/{id}', [NotaController::class, 'notasEstudiantePorId'])
    ->name('estudiante.mis-notas');


