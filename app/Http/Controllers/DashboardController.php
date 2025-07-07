<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     * @return \Illuminate\View\View
     */
    public function index() // method yang sebelumnya untuk dashboard
{
    $dataBarang = DataBarang::all(); // ambil data barang

    return view('data_barang.tabel', compact('dataBarang')); // ganti view ke data barang
}
}
