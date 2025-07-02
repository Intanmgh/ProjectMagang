<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangManajemenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes (jika nanti diaktifkan kembali)
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// -------------------------
// Barang Manajemen Routes
// -------------------------
Route::get('/barang-manajemen', [BarangManajemenController::class, 'index'])->name('barang-manajemen.index');

Route::get('/barang-manajemen/create', [BarangManajemenController::class, 'create'])->name('barang-manajemen.create');

Route::post('/barang-manajemen/store-masuk', [BarangManajemenController::class, 'storeMasuk'])->name('barang-manajemen.store-masuk');

Route::post('/barang-manajemen/store-keluar', [BarangManajemenController::class, 'storeKeluar'])->name('barang-manajemen.store-keluar');

Route::put('/barang-manajemen/update-status', [BarangManajemenController::class, 'updateStatus'])->name('barang-manajemen.update-status');

Route::get('/barang-manajemen/{item}/edit', [BarangManajemenController::class, 'edit'])->name('barang-manajemen.edit');

Route::put('/barang-manajemen/{item}', [BarangManajemenController::class, 'update'])->name('barang-manajemen.update');

Route::delete('/barang-manajemen/{item}', [BarangManajemenController::class, 'destroy'])->name('barang-manajemen.destroy');

// Halaman Tambahan
Route::get('/data-barang', function () {
    return view('data_barang.index');
})->name('data-barang.index');

Route::get('/pengembalian', function () {
    return view('pengembalian.index');
})->name('pengembalian.index');

Route::get('/notifications', function () {
    return view('notifications.index');
})->name('notifications.index');

// Route tambahan (contoh view statis barang)
Route::get('/barang', function () {
    return view('barang');
});

// Default route
Route::get('/', function () {
    return view('welcome');
});
