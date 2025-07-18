<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenjemputanController;

// web routes
// Route::get('/', function () {return view('welcome');});
Route::get('/', function () {return view('landing_page');})->name('home');
Route::get('/layanan', function () {return view('layanan_page');})->name('layanan');
Route::get('/tentang-kami', function () {return view('tentang_page');})->name('tentang');
Route::get('/register', function () {return view('auth.register');})->name('register');
Route::get('/login', function () {return view('auth.login');})->name('login');

// web khusus user
Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard', function () {return view('user.dashboard');})->name('dashboard');
});

// web khusus admin
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/penjemputan/{id}/approve', [PenjemputanController::class, 'approve'])->name('penjemputan.approve');
    Route::post('/admin/penjemputan/{id}/progress', [PenjemputanController::class, 'progress'])->name('penjemputan.progress');
    Route::post('/admin/penjemputan/{id}/reject', [PenjemputanController::class, 'reject'])->name('penjemputan.reject');
});

// Authentication routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisterController::class, 'store'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware(['auth'])->name('logout');
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::put('/update-photo', [UserController::class, 'updatePhoto'])->name('user.updatePhoto');
        Route::put('/update-profil', [UserController::class, 'updateProfil'])->name('user.updateProfil');
        Route::post('/request-penjemputan', [RequestController::class, 'create'])->name('user.requestPenjemputan');
        Route::post('/penjemputan/update-status', [RequestController::class, 'updateStatus'])->name('penjemputan.updateStatus');
        Route::put('/user/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
        // Tambah route lain sesuai kebutuhan
    });
});
