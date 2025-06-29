<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\SolicitudController;

Route::view('/', 'welcome');

Route::view('dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/*
Route::view('users', 'livewire.listar-usuarios')
    ->middleware(['auth', 'verified'])
    ->name('user'); */

//Cosas de los usuarios
/* Route::resource('usuarios', UserController::class); */
Route::get('actas',[UserController::class,'mostrarActasPersonales'])->name('personal');
Route::get('actas/ver/{id}/solicitar', [SolicitudController::class, 'registrarSolicitud'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.personal.registrar');
Route::get('actas/ver/{id}', [UserController::class, 'mostrarActa'])
    ->middleware(['auth', 'verified'])
    ->name('actas.ver');

Route::get('solicitudes',[SolicitudController::class, 'solicitudes'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes');

Route::get('solicitudes/historial',[SolicitudController::class, 'historialSolicitudes'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.historial');

Route::get('solicitudes/atender/{id}',[SolicitudController::class, 'atenderSolicitud'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.atender');

Route::get('usuarios/listar', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('usuarios.index');
Route::get('usuarios/create', [UserController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('usuarios.create');

Route::get('usuarios/edit/{id}', [UserController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('usuarios.edit');


Route::get('personas/listar', [PersonaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('personas.index');
Route::get('personas/create', [PersonaController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('personas.create');
Route::get('personas/edit/{id}', [PersonaController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('personas.edit');


/* Route::view('principal', 'livewire.principal')
    ->middleware(['auth', 'verified'])
    ->name('principal'); */

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/* Zona de los links de administrador, usaremos el controlador solo pa generar los links */
Route::get('administracion', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin');


/* Zona de los links de actas de matrimonio */

Route::get('actas/matrimonios', [FuncionarioController::class, 'indexMatrimonios'])
    ->middleware(['auth', 'verified'])
    ->name('actas-matrimonio');

Route::get('actas/matrimonios/registrar', [FuncionarioController::class, 'registrarActa'])
    ->middleware(['auth', 'verified'])
    ->name('r-a-m');


/* Zona de los links de actas de nacimiento */
Route::get('actas/nacimientos/registrar', [FuncionarioController::class, 'registrarNacimiento'])
    ->middleware(['auth', 'verified'])
    ->name('actas-nacimiento-create');

Route::get('actas/nacimientos/index', [FuncionarioController::class, 'indexNacimiento'])
    ->middleware(['auth', 'verified'])
    ->name('actas-nacimiento');
Route::get('actas/nacimientos/edit/{id}', [FuncionarioController::class, 'editNacimiento'])
    ->middleware(['auth', 'verified'])
    ->name('actas-nacimiento-edit');
Route::get('actas/nacimientos/pdf/{id}', [FuncionarioController::class, 'pdfNacimiento'])
    ->middleware(['auth', 'verified'])
    ->name('nacimientos-pdf');

Route::get('actas/matrimonios/editar/{id}', [FuncionarioController::class, 'editarActaMatrimonio'])
    ->middleware(['auth', 'verified'])
    ->name('acta-matrimonio.editar');

Route::get('actas/matrimonios/pdf/{id}', [FuncionarioController::class, 'pdfMatrimonio'])
    ->middleware(['auth', 'verified'])
    ->name('matrimonios-pdf');


Route::get('actas/defunciones', [FuncionarioController::class, 'mostrarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('mad');

Route::get('actas/defunciones/registrar', [FuncionarioController::class, 'registrarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('rad');

Route::get('actas/defunciones/editar/{id}', [FuncionarioController::class, 'editarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('ead');

Route::get('actas/defunciones/pdf/{id}', [FuncionarioController::class, 'pdf'])
    ->middleware(['auth', 'verified'])
    ->name('defunciones-pdf');


//Rutas de las solicitudes
// -> Solicitudes de una persona
Route::get('me/solicitudes',[SolicitudController::class, 'solicitudesPersonales'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.personal');

Route::get('me/solicitudes/{id}',[SolicitudController::class, 'solicitudesPersonales'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.personal.ver');

/* Route::get('solicitudes/registrar',[SolicitudController::class, 'registrarSolicitud'])
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.personal.registrar'); */

require __DIR__.'/auth.php';
