<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservacionesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('acceso');
});

Route::get('/registro', [AuthController::class, 'registerForm'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');

Route::get('/acceso', [AuthController::class, 'loginForm'])->name('acceso');
Route::post('/acceso', [AuthController::class, 'login'])->name('acceso.store');
Route::post('/cerrar', [AuthController::class, 'logout'])->name('cerrar');

Route::middleware(['auth'])->group(function () {
    Route::resource('hoteles', ReservacionesController::class)->only(['index']);
});

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])
        ->name('admin-dashboard');
});

Route::middleware(['auth', 'role:personal'])->group(function () {
    Route::get('/empleado-dashboard', [AuthController::class, 'empleadoDashboard'])
        ->name('empleado-dashboard');
});
