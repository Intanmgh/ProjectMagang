@extends('layouts.app-pimpinan')

@section('navbar-title', 'Data Barang')

@section('content')
    <h1 style="margin-bottom: 20px;">Data Barang</h1>

    <!-- Tombol Cetak -->
    <a href="{{ route('pimpinan.barangdata.pdf') }}" target="_blank" 
       style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#388E3C; color:white; border-radius:5px; text-decoration:none;">
        🖨️ Cetak Laporan
    </a>

    <!-- Tabel Data Barang -->
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:white; font-size:15px;">
            <thead style="background-color:#388E3C; color:white;">
                <tr>
                    <th style="padding:12px; border:1px solid #ccc;">Kode Barang</th>
                    <th style="padding:12px; border:1px solid #ccc;">Nama Barang</th>
                    <th style="padding:12px; border:1px solid #ccc;">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataBarang as $barang)
                    <tr>
                        <td style="padding:10px; border:1px solid #eee;">{{ $barang->kode_barang }}</td>
                        <td style="padding:10px; border:1px solid #eee;">{{ $barang->nama_barang }}</td>
                        <td style="padding:10px; border:1px solid #eee;">{{ $barang->stok }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:15px;">Tidak ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
