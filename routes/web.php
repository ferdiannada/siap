<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegister']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/aspirasi', [AdminAspirasiController::class, 'index']);
    Route::get('/aspirasi/{id}', [AdminAspirasiController::class, 'show']);
    Route::post('/aspirasi/{id}/status', [AdminAspirasiController::class, 'updateStatus']);
    Route::post('/aspirasi/{id}/progress', [AdminAspirasiController::class, 'addProgress']);
    Route::post('/aspirasi/{id}/feedback', [AdminAspirasiController::class, 'storeFeedback']);
    // categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::get('/siswa/import', [SiswaController::class, 'importForm']);
    Route::post('/siswa/import', [SiswaController::class, 'import']);

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
    Route::get('/dashboard', [SiswaDashboardController::class, 'index']);

    Route::get('/aspirasi', [SiswaAspirasiController::class, 'index']);
    Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create']);
    Route::post('/aspirasi', [SiswaAspirasiController::class, 'store']);
    Route::get('/aspirasi/{id}', [SiswaAspirasiController::class, 'show']);
    Route::get('/aspirasi/{id}/edit', [SiswaAspirasiController::class, 'edit']);
    Route::put('/aspirasi/{id}', [SiswaAspirasiController::class, 'update']);
    Route::delete('/aspirasi/{id}', [SiswaAspirasiController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {

    // API realtime notifikasi (badge)
    Route::get('/notifikasi/unread', function () {
        return response()->json([
            'count' => Auth::user()->unreadNotifications->count(),
            'data' => Auth::user()->unreadNotifications,
        ]);
    });

    Route::post('/notifikasi/read/{id}', function ($id) {
        Auth::user()
            ->notifications()
            ->where('id', $id)
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    });

});
