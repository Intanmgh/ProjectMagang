<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman; // Pastikan model ini sudah dibuat
use Illuminate\Http\Request;
use App\Http\Controllers\PeminjamanAdminController;


class PeminjamanAdminController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman_admin.index', compact('peminjaman'));
    }
}
