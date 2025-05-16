<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/umkm', function () {
    return view('pages.umkm');
});
Route::get('/wisata', function () {
    return view('pages.wisata');
});