<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas de autenticación públicas
|--------------------------------------------------------------------------
|
| Cualquiera puede acceder a login y register (sin middleware 'guest').
|
*/

// 🟦 Login (vista personalizada)
Route::get('/login', function () {
    return view('login'); // resources/views/login.blade.php
})->name('login');

// 🟦 Login (procesar formulario)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// 🟩 Register (vista personalizada)
Route::get('/register', function () {
    return view('register'); // resources/views/register.blade.php
})->name('register');

// 🟩 Register (procesar formulario)
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');

// 🔹 Logout (Livewire Breeze action)
Route::post('/logout', Logout::class)->name('logout');
