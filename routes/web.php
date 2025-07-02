<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangManajemenController; // Import controller baru
use App\Http\Controllers\Auth\LoginController; // Impor LoginController
use Illuminate\Support\Facades\Auth; // Impor Auth facade
use App\Http\Controllers\PimpinanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk halaman utama (opsional, bisa diarahkan ke login jika belum login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk Login dan Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grup route yang memerlukan autentikasi (sudah login)
Route::middleware(['auth'])->group(function () {
    // Route untuk Dashboard Admin (hanya bisa diakses oleh role 'admin')
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard'); // Buat view admin/dashboard.blade.php
        })->name('dashboard');
        // Tambahkan route khusus admin lainnya di sini
    });

    // Route untuk Dashboard Pimpinan (hanya bisa diakses oleh role 'pimpinan')
    Route::middleware(['role:pimpinan'])->group(function () {
        Route::get('/pimpinan/dashboard', function () {
            return view('pimpinan.dashboard'); // Buat view pimpinan/dashboard.blade.php
        })->name('pimpinan.dashboard');
        // Tambahkan route khusus pimpinan lainnya di sini
    });

    // Route untuk Dashboard User Biasa (hanya bisa diakses oleh role 'user')
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', function () {
            return view('user.dashboard'); // Buat view user/dashboard.blade.php
        })->name('user.dashboard');
        // Tambahkan route khusus user lainnya di sini
    });

    // Route default setelah login jika tidak ada role yang cocok (opsional)
    // Atau bisa juga route home umum untuk semua yang sudah login
    Route::get('/home', function () {
        return "Anda sudah login, tapi tidak ada dashboard spesifik untuk role Anda.";
    })->name('home');
}); 


// Dashboard Route (Ini sekarang di luar grup auth, atau Anda bisa pindahkan ke dalam jika perlu auth)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk Halaman Manajemen Barang Gabungan (Resource-like routes)
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

Route::prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/dashboard', [PimpinanController::class, 'dashboard'])->name('dashboard'); 
   Route::get('/barang-masuk', [PimpinanController::class, 'barangMasuk'])->name('barang-masuk');
    Route::get('/barang-keluar', [PimpinanController::class, 'barangKeluar'])->name('barang-keluar');
    Route::get('/databarang', [PimpinanController::class, 'dataBarang'])->name('databarang');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::get('/barang-masuk/cetak', [PimpinanController::class, 'cetakBarangMasuk'])->name('cetak-barang-masuk');
Route::get('/barang-keluar/cetak', [PimpinanController::class, 'cetakBarangKeluar'])->name('cetak-barang-keluar');
Route::get('/databarang/cetak', [PimpinanController::class, 'cetakDataBarang'])->name('cetak-databarang');