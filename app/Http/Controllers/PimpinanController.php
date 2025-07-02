<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    // Halaman Dashboard Pimpinan
    public function dashboard() {
        // Dummy data sementara
        $barangMasuk = 12;
        $barangKeluar = 7;
        $totalBarang = 30;

        return view('pimpinan.dashboard-pimpinan', compact('barangMasuk', 'barangKeluar', 'totalBarang'));
    }

    // Halaman Barang Masuk
    public function barangMasuk() {
        $data = collect(); // Bisa diisi data dari database nanti
        return view('pimpinan.masuk', compact('data'));
    }

    // Halaman Barang Keluar
    public function barangKeluar() {
        $data = collect(); // Bisa diisi data dari database nanti
        return view('pimpinan.keluar', compact('data'));
    }

    // Halaman Data Barang
   public function dataBarang() {
    $data = collect(); // bisa diganti dengan data asli nantinya
    return view('pimpinan.data', compact('data'));
}

public function cetakBarangMasuk() {
    $data = collect(); // bisa isi data asli nanti
    return view('pimpinan.cetak.masuk', compact('data'));
}

public function cetakBarangKeluar() {
    $data = collect(); 
    return view('pimpinan.cetak.keluar', compact('data'));
}

public function cetakDataBarang() {
    $data = collect(); 
    return view('pimpinan.cetak.data', compact('data'));
}


}
