<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Ruta principal que redirige según el estado de autenticación
Route::get('/', function () {
    if (auth()->check()) {
        return view('welcome'); // Usuario autenticado: mostrar calendario
    }
    return redirect()->route('login'); // Si no ha iniciado sesión: redirigir al login
});


// Rutas para las citas
Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

// Rutas para el registro de usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas para el inicio de sesión
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Ruta para el cierre de sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

