<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaBarang;
use App\Models\DataBarang;
use Illuminate\Support\Str;

class BarangManajemenController extends Controller
{
    public function index()
    {
        $dataBarang = KelolaBarang::orderBy('tanggal', 'desc')->paginate(10);
        return view('barang_manajemen.index', compact('dataBarang'));
    }

    public function create()
    {
        return view('barang_manajemen.create');
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Generate ID Barang otomatis (misal: BRG-0001)
        $last = KelolaBarang::latest()->first();
        $lastNumber = $last ? intval(Str::after($last->id_barang_masuk, 'BRG-')) : 0;
        $newId = 'BRG-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        try {
            // Simpan ke tabel kelola_barang
            KelolaBarang::create([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $newId,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
            ]);

            // Update atau tambah stok di data_barangs
            $barang = DataBarang::firstOrNew([
                'kode_barang' => $request->kode_barang,
            ]);

            $barang->nama_barang = $request->nama_barang;
            $barang->stok = ($barang->stok ?? 0) + $request->jumlah;
            $barang->save();

            return redirect()->route('barang-manajemen.index')->with('success', 'Barang masuk berhasil & stok diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan barang masuk: ' . $e->getMessage()]);
        }
    }

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
            $barang = DataBarang::where('kode_barang', $request->kode_barang)->first();

            if (!$barang || $barang->stok < $request->jumlah) {
                return back()->withErrors(['error' => 'Stok tidak cukup atau barang tidak ditemukan.']);
            }

            $barang->stok -= $request->jumlah;
            $barang->save();

            // Simpan log keluar ke kelola_barang
            KelolaBarang::create([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $request->id_barang_keluar, // bisa pakai format khusus jika mau
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'jumlah' => -$request->jumlah, // negatif = keluar
            ]);

            return redirect()->route('barang-manajemen.index')->with('success', 'Barang keluar berhasil & stok dikurangi!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memproses barang keluar: ' . $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|string|max:255',
            'status_baru' => 'required|string|max:255',
            'lokasi_baru' => 'nullable|string|max:255',
        ]);

        try {
            $barang = KelolaBarang::where('id_barang_masuk', $request->id_barang)
                                   ->orWhere('kode_barang', $request->id_barang)
                                   ->first();

            if ($barang) {
                $barang->status = $request->status_baru;
                if ($request->filled('lokasi_baru')) {
                    $barang->lokasi = $request->lokasi_baru;
                }
                $barang->save();

                return redirect()->route('barang-manajemen.index')->with('success', 'Status barang berhasil diperbarui!');
            } else {
                return back()->withErrors(['error' => 'Barang tidak ditemukan.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui status: ' . $e->getMessage()]);
        }
    }

    public function edit(KelolaBarang $item)
    {
        return view('barang_manajemen.edit', compact('item'));
    }

    public function update(Request $request, KelolaBarang $item)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_barang_masuk' => 'required|string|unique:kelola_barang,id_barang_masuk,' . $item->id,
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        try {
            $item->update([
                'tanggal' => $request->tanggal,
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah' => $request->jumlah,
            ]);

            return redirect()->route('barang-manajemen.index')->with('success', 'Data barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }

    public function destroy(KelolaBarang $item)
    {
        try {
            $item->delete();
            return redirect()->route('barang-manajemen.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus: ' . $e->getMessage()]);
        }
    }

    // Tambahan jika ingin menampilkan semua data barang (stok)
    public function dataBarang()
    {
        $data = DataBarang::orderBy('kode_barang')->get();
        return view('data_barang.index', compact('data'));
    }
}
