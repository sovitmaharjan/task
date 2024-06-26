<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/user', UserController::class)->except('show');

    Route::resource('/artist', ArtistController::class)->except('show');
    Route::get('/artist-export', [ArtistController::class, 'export'])->name('artist.export');
    Route::post('/artist-import', [ArtistController::class, 'import'])->name('artist.import');

    Route::resource('music', MusicController::class)->except('index', 'create', 'show');
    Route::get('/music/{artist_id}', [MusicController::class, 'index'])->name('music.index');
    Route::get('/music/create/{artist_id}', [MusicController::class, 'create'])->name('music.create');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.index');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.index');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// commit alias test 6