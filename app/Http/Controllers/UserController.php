<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;

class UserController extends Controller
{
    public function databarang()
    {
        return view('user.databarang');
    }

      public function pengajuan()
    {
        $pengajuans = Pengajuan::orderBy('created_at', 'desc')->get();
        return view('user.pengajuan', compact('pengajuans'));
    }

    public function storePengajuan(Request $request)
    {
    // Validasi input user (id_peminjaman tidak divalidasi karena akan digenerate otomatis)
    $request->validate([
        'tanggal_peminjaman' => 'required|date',
        'nama_peminjam' => 'required|string',
        'nama_barang' => 'required|string',
        'jumlah' => 'required|integer|min:1',
    ]);

    // Generate ID peminjaman otomatis tanpa tanggal
    $last = Pengajuan::orderBy('created_at', 'desc')->first();
    $lastNumber = $last ? intval(substr($last->id_peminjaman, -4)) : 0;
    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    $newId = 'PMJ-' . $newNumber;


    // Simpan data ke database
    Pengajuan::create([
        'id_peminjaman' => $newId,
        'tanggal_peminjaman' => $request->tanggal_peminjaman,
        'nama_peminjam' => $request->nama_peminjam,
        'nama_barang' => $request->nama_barang,
        'jumlah' => $request->jumlah,
        'status_barang' => 'menunggu', // default
    ]);

    return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logout user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // arahkan ke halaman login
    }
}
