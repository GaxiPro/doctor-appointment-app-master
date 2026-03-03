<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PacientController;

// Ruta del dashboard
Route::get('/', function () {
    return view(('admin.dashboard'));
})->name('dashboard');

// Gestión de roles y permisos
Route::resource(
    'roles', 
    RoleController::class
);

// Gestión de usuarios
Route::resource('users', UserController::class);

// Gestión de pacientes
Route::resource('patients', PacientController::class);

// Gestión de doctores
Route::resource('doctors', DoctorController::class)->except(['show']);
Route::get('doctors/{doctor}/show', [DoctorController::class, 'show'])->name('doctors.show');

// Gestión de tickets de soporte
Route::resource('support', SupportController::class);