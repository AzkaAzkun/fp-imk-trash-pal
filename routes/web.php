<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

// web routes
Route::get('/', function () {return view('welcome');});
Route::get('/home', function () {return view('landing_page');})->name('home');
Route::get('/register', function () {return view('auth.register');})->name('register');
Route::get('login', function () {return view('auth.login');})->name('login');

// Authentication routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
});
