@extends('layouts.app-pimpinan')

@section('content')
    <div class="container-fluid px-5 py-4">
        <h2 class="mb-4" style="font-weight: 600;">Data Barang Masuk</h2>

       <a href="{{ route('pimpinan.barangmasuk.pdf') }}" target="_blank" 
   style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#388E3C; color:white; border-radius:5px; text-decoration:none;">
    🖨️ Cetak Laporan
</a>


        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; background:white; font-size:15px;">
                <thead style="background-color:#388E3C; color:white;">
                    <tr>
                        <th style="padding:12px; border:1px solid #ccc;">Tanggal</th>
                        <th style="padding:12px; border:1px solid #ccc;">ID Barang</th>
                        <th style="padding:12px; border:1px solid #ccc;">Kode Barang</th>
                        <th style="padding:12px; border:1px solid #ccc;">Nama Barang</th>
                        <th style="padding:12px; border:1px solid #ccc;">Jumlah</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataBarang as $barang)
                        <tr>
                            <td style="padding:10px; border:1px solid #eee;">{{ \Carbon\Carbon::parse($barang->tanggal)->format('d-m-Y') }}</td>
                            <td style="padding:10px; border:1px solid #eee;">{{ $barang->id_barang_masuk ?? '-' }}</td>
                            <td style="padding:10px; border:1px solid #eee;">{{ $barang->kode_barang }}</td>
                            <td style="padding:10px; border:1px solid #eee;">{{ $barang->nama_barang }}</td>
                            <td style="padding:10px; border:1px solid #eee;">{{ $barang->jumlah }}</td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:15px;">Tidak ada data barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
