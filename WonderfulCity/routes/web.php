<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

// MAIN //

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');


// ADMIN //
// Hal Dashboard
Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
// Hal Landing 
Route::get('/admin/landing', [LandingController::class, 'show'])->name('landing.show'); //show
Route::get('/admin/landing/edit', [LandingController::class, 'edit'])->name('landing.edit'); //open form
Route::post('/admin/landing/update', [LandingController::class, 'update'])->name('landing.update'); //send changes