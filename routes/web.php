<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangManajemenController; // Import controller baru
use App\Http\Controllers\Auth\LoginController; // Impor LoginController
use Illuminate\Support\Facades\Auth; // Impor Auth facade
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DataBarangController;
 

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

Route::post('/barang-masuk', [BarangManajemenController::class, 'storeMasuk'])->name('barang-manajemen.storeMasuk');
Route::get('/data-barang', [BarangManajemenController::class, 'dataBarang'])->name('data-barang.index');
// Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');


// // Halaman Tambahan
// Route::get('/data-barang', function () {
//     return view('data_barang.index');
// })->name('data-barang.index');

// Route::get('/peminjaman_admin', function () {
//     return view('peminjaman_admin.index');
// })->name('peminjaman_admin.index');

// Route::get('/notifications', function () {
//     return view('notifications.index');
// })->name('notifications.index');

Route::prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/dashboard', [PimpinanController::class, 'dashboard'])->name('dashboard'); 
   Route::get('/barang-masuk', [PimpinanController::class, 'barangMasuk'])->name('barang-masuk');
    Route::get('/barang-keluar', [PimpinanController::class, 'barangKeluar'])->name('barang-keluar');
    Route::get('/databarang', [PimpinanController::class, 'dataBarang'])->name('databarang');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
// Route untuk Cetak PDF Barang Masuk oleh Pimpinan
Route::get('/pimpinan/barang-masuk/pdf', [PimpinanController::class, 'cetakPDF'])
    ->name('pimpinan.barangmasuk.pdf');


// Route halaman cetak untuk barang keluar
Route::get('/pimpinan/cetak/barang-keluar', [PimpinanController::class, 'cetakBarangKeluar'])->name('pimpinan.cetak.barangKeluar');

// Route halaman cetak untuk data barang (stok)
Route::get('/pimpinan/cetak/data-barang', [PimpinanController::class, 'cetakDataBarang'])->name('pimpinan.cetak.dataBarang');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


//USER
Route::get('/user/dashboard', function () {
    return view('user.dashboard-user');
});

Route::post('/user/logout', function () {
    Auth::logout();
    return redirect('/login'); // atau redirect ke halaman login user
})->name('user.logout');

Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/user/databarang', [UserController::class, 'dataBarang'])->name('user.databarang');
Route::get('/user/pengajuan', [UserController::class, 'pengajuan'])->name('user.pengajuan');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/databarang', [UserController::class, 'dataBarang'])->name('user.dataBarang');
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/pengajuan', [UserController::class, 'databarang'])->name('user.databarang');

    Route::get('/pengajuan', [UserController::class, 'pengajuan'])->name('user.pengajuan');
    Route::post('/pengajuan', [UserController::class, 'storePengajuan'])->name('user.pengajuan.store');

    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
});


Route::get('/pimpinan/kelola-barang', [PimpinanController::class, 'kelolaBarang'])
    ->middleware('role:pimpinan')
    ->name('pimpinan.kelola');


Route::get('/pimpinan/data-barang/cetak', [PimpinanController::class, 'cetakPDFDataBarang'])->name('pimpinan.barangdata.pdf');


//Route utuk admin baru
Route::resource('jenis', JenisController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('lokasi', LokasiController::class);
Route::resource('barang', BarangController::class);

Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
Route::get('/data-barang', [DataBarangController::class, 'index'])->name('databarang.index');

Route::get('/jenis', function () {
    $data = [
        ['jenis' => 'Operasional', 'keterangan' => 'Inventaris yang terlibat dalam operasi sehari-hari'],
        ['jenis' => 'Persediaan', 'keterangan' => 'Inventaris yang digunakan untuk menunjang operasi sehari-hari'],
        ['jenis' => 'Administrasi', 'keterangan' => 'Inventaris peralatan kantor'],
        ['jenis' => 'Kendaraan Dinas', 'keterangan' => 'Milik Dimas Kanjeng Taat Pribadi'],
        ['jenis' => 'test notif berhasil', 'keterangan' => '123'],
    ];
    return view('jenis.index', compact('data'));
})->name('jenis.index');

Route::get('/jenis/create', function () {
    return "<h3 style='padding: 2rem'>Form Tambah Jenis Barang</h3>";
})->name('jenis.create');

Route::get('/satuan', function () {
    $data = [
        ['id' => 'STN-001', 'nama' => 'Buah'],
        ['id' => 'STN-002', 'nama' => 'Unit'],
        ['id' => 'STN-003', 'nama' => 'Paket'],
    ];
    return view('satuan.index', compact('data'));
})->name('satuan.index');

Route::get('/lokasi', function () {
    $data = [
        ['id' => 'LKS-001', 'nama' => 'Gudang A'],
        ['id' => 'LKS-002', 'nama' => 'Gudang B'],
        ['id' => 'LKS-003', 'nama' => 'Rak 3'],
    ];
    return view('lokasi.index', compact('data'));
})->name('lokasi.index');

Route::get('/barang', function () {
    $data = [
        [
            'id' => 'BRG-001',
            'nama' => 'Meja',
            'jenis' => 'Perabot',
            'satuan' => 'Buah',
            'lokasi' => 'Gudang A',
        ],
        [
            'id' => 'BRG-002',
            'nama' => 'Laptop',
            'jenis' => 'Elektronik',
            'satuan' => 'Unit',
            'lokasi' => 'Gudang B',
        ],
        [
            'id' => 'BRG-003',
            'nama' => 'Kursi',
            'jenis' => 'Perabot',
            'satuan' => 'Buah',
            'lokasi' => 'Rak 3',
        ],
    ];
    return view('barang.index', compact('data'));
})->name('barang.index');
