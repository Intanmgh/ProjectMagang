<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk; // Import model BarangMasuk
// use App\Models\BarangKeluar; // Jika Anda punya model BarangKeluar terpisah
// use App\Models\Barang; // Jika Anda punya model Barang Master terpisah

class BarangManajemenController extends Controller
{
    /**
     * Menampilkan halaman manajemen barang gabungan (dengan tab).
     * Mengambil data untuk tab "Data Barang".
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data untuk tab "Data Barang"
        // Asumsi: kita mengambil dari model BarangMasuk.
        // Jika Anda memiliki model 'Barang' yang mewakili stok keseluruhan, gunakan itu.
        // Contoh: $dataBarang = Barang::orderBy('created_at', 'desc')->paginate(10);

        $dataBarang = BarangMasuk::orderBy('tanggal', 'desc')->paginate(10); // Ambil 10 item per halaman, diurutkan berdasarkan tanggal

        return view('barang_manajemen.index', compact('dataBarang'));
    }

    /**
     * Menyimpan data barang masuk baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMasuk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_barang_masuk' => 'required|string|unique:barang_masuk,id_barang_masuk',
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        try {
            BarangMasuk::create([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
            ]);

            return redirect()->route('barang-manajemen.index')->with('success', 'Barang masuk berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan barang masuk: ' . $e->getMessage()]);
        }
    }

    /**
     * Memproses data barang keluar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeKeluar(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_barang_keluar' => 'required|string',
            'kode_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tujuan' => 'required|string|max:255',
        ]);

        try {
            // Logika untuk memproses barang keluar.
            // Anda perlu mengimplementasikan pengurangan stok dari tabel barang utama
            // atau mencatat transaksi di tabel 'barang_keluar' terpisah.

            // Contoh: Mengurangi stok dari model BarangMasuk (jika itu tabel stok Anda)
            // $barang = BarangMasuk::where('kode_barang', $request->kode_barang)->first();
            // if ($barang && $barang->jumlah >= $request->jumlah) {
            //     $barang->jumlah -= $request->jumlah; // Asumsi 'jumlah' adalah stok
            //     $barang->save();
            //     // Catat juga transaksi keluar di tabel terpisah jika diperlukan
            //     return redirect()->route('barang-manajemen.index')->with('success', 'Barang keluar berhasil diproses!');
            // } else {
            //     return redirect()->back()->withInput()->withErrors(['error' => 'Stok tidak cukup atau barang tidak ditemukan.']);
            // }

            return redirect()->route('barang-manajemen.index')->with('success', 'Barang keluar berhasil diproses (logika stok perlu diimplementasikan)!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memproses barang keluar: ' . $e->getMessage()]);
        }
    }

    /**
     * Memperbarui status barang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|string|max:255',
            'status_baru' => 'required|string|max:255',
            'lokasi_baru' => 'nullable|string|max:255',
        ]);

        try {
            // Logika untuk memperbarui status barang.
            // Anda perlu menambahkan kolom 'status' dan 'lokasi' di tabel database Anda.
            $barang = BarangMasuk::where('id_barang_masuk', $request->id_barang)
                               ->orWhere('kode_barang', $request->id_barang)
                               ->first();

            if ($barang) {
                $barang->status = $request->status_baru; // Kolom 'status' harus ada di tabel
                if ($request->filled('lokasi_baru')) {
                    $barang->lokasi = $request->lokasi_baru; // Kolom 'lokasi' harus ada di tabel
                }
                $barang->save();

                return redirect()->route('barang-manajemen.index')->with('success', 'Status barang berhasil diperbarui!');
            } else {
                return redirect()->back()->withInput()->withErrors(['error' => 'Barang dengan ID/Kode tersebut tidak ditemukan.']);
            }

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui status barang: ' . $e->getMessage()]);
        }
    }

    /**
     * Menampilkan form edit untuk item barang.
     * Anda perlu membuat view resources/views/barang_manajemen/edit.blade.php
     *
     * @param  \App\Models\BarangMasuk  $item
     * @return \Illuminate\View\View
     */
    public function edit(BarangMasuk $item)
    {
        return view('barang_manajemen.edit', compact('item'));
    }

    /**
     * Memperbarui item barang di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BarangMasuk $item)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_barang_masuk' => 'required|string|unique:barang_masuk,id_barang_masuk,' . $item->id,
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            // Tambahkan validasi untuk status dan lokasi jika relevan
            // 'status' => 'nullable|string',
            // 'lokasi' => 'nullable|string',
        ]);

        try {
            $item->update([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
                // Update juga status dan lokasi jika ada di form edit
                // 'status' => $request->status,
                // 'lokasi' => $request->lokasi,
            ]);

            return redirect()->route('barang-manajemen.index')->with('success', 'Data barang berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui data barang: ' . $e->getMessage()]);
        }
    }

    /**
     * Menghapus item barang dari database.
     *
     * @param  \App\Models\BarangMasuk  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BarangMasuk $item)
    {
        try {
            $item->delete();
            return redirect()->route('barang-manajemen.index')->with('success', 'Data barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data barang: ' . $e->getMessage()]);
        }
    }
}
