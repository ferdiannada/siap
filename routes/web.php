<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Siswa\AspirasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'));
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', fn() => view('siswa.dashboard'));
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {

    Route::get('/dashboard', fn() => view('siswa.dashboard'));

    Route::get('/aspirasi', [AspirasiController::class, 'index']);
    Route::get('/aspirasi/create', [AspirasiController::class, 'create']);
    Route::post('/aspirasi', [AspirasiController::class, 'store']);
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'show']);
    Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit']);
    Route::put('/aspirasi/{id}', [AspirasiController::class, 'update']);
    Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy']);
});
