<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangManajemenController; // Import controller baru

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk Halaman Manajemen Barang Gabungan (Resource-like routes)
// Ini adalah cara yang lebih ringkas untuk mendefinisikan CRUD routes
Route::get('/barang-manajemen', [BarangManajemenController::class, 'index'])->name('barang-manajemen.index');
Route::post('/barang-manajemen/store-masuk', [BarangManajemenController::class, 'storeMasuk'])->name('barang-manajemen.store-masuk');
Route::post('/barang-manajemen/store-keluar', [BarangManajemenController::class, 'storeKeluar'])->name('barang-manajemen.store-keluar');
Route::put('/barang-manajemen/update-status', [BarangManajemenController::class, 'updateStatus'])->name('barang-manajemen.update-status');

// Tambahan routes untuk Edit dan Delete (CRUD pada data tabel)
Route::get('/barang-manajemen/{item}/edit', [BarangManajemenController::class, 'edit'])->name('barang-manajemen.edit');
Route::put('/barang-manajemen/{item}', [BarangManajemenController::class, 'update'])->name('barang-manajemen.update');
Route::delete('/barang-manajemen/{item}', [BarangManajemenController::class, 'destroy'])->name('barang-manajemen.destroy');

// Route untuk Data Barang (jika Anda ingin halaman terpisah selain di tab)
Route::get('/data-barang', function () {
    return view('data_barang.index'); // Buat view ini jika diperlukan
})->name('data-barang.index');

// Route untuk Pengembalian (jika Anda ingin halaman terpisah)
Route::get('/pengembalian', function () {
    return view('pengembalian.index'); // Buat view ini jika diperlukan
})->name('pengembalian.index');

// Route untuk Notifikasi (jika Anda ingin halaman terpisah)
Route::get('/notifications', function () {
    return view('notifications.index'); // Buat view ini jika diperlukan
})->name('notifications.index');

// Route default (biasanya ke welcome page atau login)
Route::get('/', function () {
    return view('welcome');
});
