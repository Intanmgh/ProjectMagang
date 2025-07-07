<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\KelolaBarang;

class BarangManajemenController extends Controller
{
    public function storeMasuk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_barang_masuk' => 'required|string|unique:kelola_barang,id_barang_masuk',
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        try {
            // Simpan ke kelola_barang
            KelolaBarang::create([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
            ]);

            // Tambah atau update stok di data_barangs
            $barang = DataBarang::firstOrNew(['kode_barang' => $request->kode_barang]);
            $barang->nama_barang = $request->nama_barang;
            $barang->stok += $request->jumlah;
            $barang->save();

            return redirect()->route('barang-manajemen.index')->with('success', 'Barang masuk berhasil ditambahkan & stok diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan barang masuk: ' . $e->getMessage()]);
        }
    }
}
