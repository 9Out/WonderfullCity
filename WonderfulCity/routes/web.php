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
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');

// Content
Route::get('/umkm/1', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/wisata/{id}', [WisataController::class, 'show'])->name('wisata.show');  


// ADMIN // -> Perlu Modifikasi Agar Bisa diAses saat login saja
// Hal Dashboard
Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
// Hal Landing 
Route::get('/admin/landing', [LandingController::class, 'show'])->name('landing.show'); //show
Route::get('/admin/landing/edit', [LandingController::class, 'edit'])->name('landing.edit'); //open form
Route::post('/admin/landing/update', [LandingController::class, 'update'])->name('landing.update'); //send changes
// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login-submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Lupa Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
