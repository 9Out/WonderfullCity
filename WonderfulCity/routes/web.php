<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;

// MAIN //

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/search-umkm', [UmkmController::class, 'search'])->name('umkm.search');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/search-wisata', [WisataController::class, 'search'])->name('wisata.search');

// Content
Route::get('/umkm/{slug}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/wisata/{slug}', [WisataController::class, 'show'])->name('wisata.show');  


// Halaman ADMIN (Dengan proteksi auth)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Landing Page 
    Route::get('/admin/landing', [LandingController::class, 'show'])->name('landing.show'); //show
    Route::get('/admin/landing/edit', [LandingController::class, 'edit'])->name('landing.edit'); //open form
    Route::post('/admin/landing/update', [LandingController::class, 'update'])->name('landing.update'); //send changes

    // UMKM
    Route::get('admin/umkm', [UmkmController::class, 'admindex'])->name('umkm.admin');
    Route::get('admin/umkm-create', [UmkmController::class, 'create'])->name('umkm.create');
    Route::post('admin/umkm-store', [UmkmController::class, 'store'])->name('umkm.store');
    Route::get('admin/umkm-edit/{umkm}', [UmkmController::class, 'edit'])->name('umkm.edit');
    Route::put('admin/umkm-update/{umkm}', [UmkmController::class, 'update'])->name('umkm.update');
    Route::delete('/admin/umkm-delete/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy');

    // Wisata
    Route::get('admin/wisata', [WisataController::class, 'admindex'])->name('wisata.admin');
    Route::get('admin/wisata-create', [WisataController::class, 'create'])->name('wisata.create');
    Route::post('admin/wisata-store', [WisataController::class, 'store'])->name('wisata.store');
    Route::get('admin/wisata-edit/{wisata}', [WisataController::class, 'edit'])->name('wisata.edit');
    Route::put('admin/wisata-update/{wisata}', [WisataController::class, 'update'])->name('wisata.update');
    Route::delete('/admin/wisata-delete/{wisata}', [WisataController::class, 'destroy'])->name('wisata.destroy');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login-submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
