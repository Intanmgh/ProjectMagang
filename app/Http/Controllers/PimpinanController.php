<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaBarang;
use App\Models\DataBarang;
use PDF; // Tambahkan ini jika pakai dompdf

class PimpinanController extends Controller
{
    // Halaman Dashboard Pimpinan
    public function dashboard()
    {
        $barangMasuk = KelolaBarang::where('jumlah', '>', 0)->count();
        $barangKeluar = KelolaBarang::where('jumlah', '<', 0)->count();
        $totalBarang = DataBarang::sum('stok');

        return view('pimpinan.dashboard-pimpinan', compact('barangMasuk', 'barangKeluar', 'totalBarang'));
    }

    // Halaman Barang Masuk
    public function barangMasuk()
    {
        $dataBarang = KelolaBarang::where('jumlah', '>', 0)->orderBy('tanggal', 'desc')->get();
        return view('pimpinan.masuk', compact('dataBarang'));
    }

    // Halaman Barang Keluar
    public function barangKeluar()
    {
        $dataBarang = KelolaBarang::where('jumlah', '<', 0)->orderBy('tanggal', 'desc')->get();
        return view('pimpinan.keluar', compact('dataBarang'));
    }

    // Halaman Data Barang (stok saat ini)
    public function dataBarang()
    {
        $dataBarang = DataBarang::orderBy('kode_barang')->get();
        return view('pimpinan.data', compact('dataBarang'));
    }

    // ✅ Cetak PDF Barang Masuk
    public function cetakPDFBarangMasuk()
    {
        $dataBarang = KelolaBarang::where('jumlah', '>', 0)->orderBy('tanggal', 'desc')->get();
        $pdf = PDF::loadView('pimpinan.cetak.masuk', compact('dataBarang'));
        return $pdf->download('barang-masuk.pdf');
    }

    // Cetak PDF Barang Keluar
    public function cetakPDFBarangKeluar()
    {
        $dataBarang = KelolaBarang::where('jumlah', '<', 0)->orderBy('tanggal', 'desc')->get();
        $pdf = PDF::loadView('pimpinan.cetak.keluar', compact('dataBarang'));
        return $pdf->download('barang-keluar.pdf');
    }

    // Cetak PDF Data Barang
    public function cetakPDFDataBarang()
    {
        $dataBarang = DataBarang::orderBy('kode_barang')->get();
        $pdf = PDF::loadView('pimpinan.cetak.data', compact('dataBarang'));
        return $pdf->download('data-barang.pdf');
    }
}
