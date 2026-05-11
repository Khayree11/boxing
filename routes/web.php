<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminMatchController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminAuthMiddleware;

// 1. Halaman utama untuk User (Guest / Publik, tidak perlu login)
Route::get('/', [EventController::class, 'index'])->name('home');

// --- TAMBAHAN ROUTE UNTUK NAVBAR ---
Route::get('/events', function () {
    return "Halaman Jadwal Event Lengkap (Coming Soon)";
})->name('events');

Route::get('/fighters', function () {
    return "Halaman Profil Fighter (Coming Soon)";
})->name('fighters');
// -----------------------------------

// 2. Jalur Login Admin (Tampil di /admin)
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// 3. Halaman Manajemen Admin (Terproteksi Middleware)
Route::prefix('admin')->middleware(AdminAuthMiddleware::class)->group(function () {
    
    Route::get('/matches', [AdminMatchController::class, 'index'])->name('admin.matches.index');
    Route::post('/matches', [AdminMatchController::class, 'store'])->name('admin.matches.store');
    Route::put('/matches/{id}/status', [AdminMatchController::class, 'updateStatus'])->name('admin.matches.updateStatus');
    Route::delete('/matches/{id}', [AdminMatchController::class, 'destroy'])->name('admin.matches.destroy');
    
});