<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AbsensiController::class, 'index'])->name('dashboard');
    Route::post('/absen-masuk', [AbsensiController::class, 'absenMasuk'])->name('absen.masuk');
    Route::post('/absen-keluar', [AbsensiController::class, 'absenKeluar'])->name('absen.keluar');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
