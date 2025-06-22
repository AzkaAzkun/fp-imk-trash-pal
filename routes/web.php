<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// web routes
Route::get('/', function () {return view('welcome');});
Route::get('/home', function () {return view('landing_page');})->name('home');
Route::get('/layanan', function () {return view('layanan_page');})->name('layanan');
Route::get('/tentang-kami', function () {return view('tentang_page');})->name('tentang');
Route::get('/register', function () {return view('auth.register');})->name('register');
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {return view('user.dashboard');})->name('dashboard');
});

// Authentication routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
