<?php

use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/aspirasi/{id}', [AdminAspirasiController::class, 'show']);
    Route::post('/aspirasi/{id}/status', [AdminAspirasiController::class, 'updateStatus']);
    Route::post('/aspirasi/{id}/progress', [AdminAspirasiController::class, 'addProgress']);
    Route::post('/aspirasi/{id}/feedback', [AdminAspirasiController::class, 'storeFeedback']);

});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/notifikasi', function () {
        $notifikasi = Auth::user()->notifications;
        return view('siswa.notifikasi', compact('notifikasi'));
    });

    Route::post('/notifikasi/{id}/read', function ($id) {
        Auth::user()->notifications()->find($id)->markAsRead();
        return back();
    });
    Route::get('/dashboard', fn() => view('siswa.dashboard'));

    Route::get('/aspirasi', [SiswaAspirasiController::class, 'index']);
    Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create']);
    Route::post('/aspirasi', [SiswaAspirasiController::class, 'store']);
    Route::get('/aspirasi/{id}', [SiswaAspirasiController::class, 'show']);
    Route::get('/aspirasi/{id}/edit', [SiswaAspirasiController::class, 'edit']);
    Route::put('/aspirasi/{id}', [SiswaAspirasiController::class, 'update']);
    Route::delete('/aspirasi/{id}', [SiswaAspirasiController::class, 'destroy']);
});
