<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonaController;

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

require __DIR__.'/auth.php';
