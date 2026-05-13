<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminMatchController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\FighterController;
use App\Http\Middleware\AdminAuthMiddleware;

// ==========================================
// 1. HALAMAN PENGUNJUNG (PUBLIK)
// ==========================================
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/fighters', [EventController::class, 'fighters'])->name('fighters');

// Halaman Events (Sudah benar mengarah ke desain Poster Tiket)
Route::get('/events', [EventController::class, 'eventsList'])->name('events');


// ==========================================
// 2. JALUR LOGIN ADMIN
// ==========================================
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ==========================================
// 3. HALAMAN MANAJEMEN ADMIN (Terproteksi)
// ==========================================
Route::prefix('admin')->middleware(AdminAuthMiddleware::class)->group(function () {
    
    // Manajemen Pertandingan
    Route::get('/matches', [AdminMatchController::class, 'index'])->name('admin.matches.index');
    Route::post('/matches', [AdminMatchController::class, 'store'])->name('admin.matches.store');
    Route::put('/matches/{id}/status', [AdminMatchController::class, 'updateStatus'])->name('admin.matches.updateStatus');
    Route::delete('/matches/{id}', [AdminMatchController::class, 'destroy'])->name('admin.matches.destroy');
    
    // Manajemen Setting Global (YouTube)
    Route::post('/settings/youtube', [AdminMatchController::class, 'updateYoutube'])->name('admin.settings.youtube');
    
    // Manajemen Setting Global (Event & Tiket)
    Route::post('/settings/event', [AdminMatchController::class, 'updateEvent'])->name('admin.settings.event');

    // Manajemen Petarung (Fighters)
    Route::get('/fighters', [FighterController::class, 'index'])->name('admin.fighters.index');
    Route::post('/fighters', [FighterController::class, 'store'])->name('admin.fighters.store');
    Route::put('/fighters/{id}', [FighterController::class, 'update'])->name('admin.fighters.update');
    Route::delete('/fighters/{id}', [FighterController::class, 'destroy'])->name('admin.fighters.destroy');
    
});