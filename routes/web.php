<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\FuncionarioController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/*
Route::view('users', 'livewire.listar-usuarios')
    ->middleware(['auth', 'verified'])
    ->name('user'); */

Route::resource('usuarios', UserController::class);

Route::resource('personas',PersonaController::class);



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

Route::get('actas/matrimonios', [FuncionarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('actas-matrimonio');

Route::get('actas/matrimonios/registrar', [FuncionarioController::class, 'registrarActa'])
    ->middleware(['auth', 'verified'])
    ->name('r-a-m');

Route::get('actas/matrimonios/editar/{id}', [FuncionarioController::class, 'editarActaMatrimonio'])
    ->middleware(['auth', 'verified'])
    ->name('acta-matrimonio.editar');

Route::get('actas/defunciones', [FuncionarioController::class, 'mostrarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('mad');

Route::get('actas/defunciones/registrar', [FuncionarioController::class, 'registrarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('rad');

Route::get('actas/defunciones/editar/{id}', [FuncionarioController::class, 'editarActaDefunciones'])
    ->middleware(['auth', 'verified'])
    ->name('ead');

require __DIR__.'/auth.php';
