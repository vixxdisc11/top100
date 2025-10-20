<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;




Route::get('/login', function () {
    return view('login'); // resources/views/login.blade.php
})->name('login');


Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');


Route::get('/register', function () {
    return view('register'); 
})->name('register');


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');


Route::post('/logout', Logout::class)->name('logout');
