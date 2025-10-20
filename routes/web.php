<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\CryptoDetail;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Livewire;


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/', function () {
        return view('cryptos');
    })->name('home');


    Route::get('/2', function () {
        return view('searchs');
    })->name('crypto.search');


    Route::get('/crypto/{id}', function ($id) {
        return Livewire::mount('crypto-detail', ['id' => $id])->html();
    })->name('crypto.detail');
Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'list'])->name('favorites.list');

});

require __DIR__.'/auth.php';
