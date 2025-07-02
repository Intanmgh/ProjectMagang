@extends('layouts.app-pimpinan')

@section('navbar-title', 'Barang Masuk')

@section('content')
    <h1>Kelola Barang</h1>

    <!-- Tombol Cetak -->
    <a href="{{ url('/pimpinan/barang-masuk/cetak') }}" target="_blank" 
       style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#388E3C; color:white; border-radius:5px; text-decoration:none;">
        🖨️ Cetak Laporan
    </a>

    <!-- Tabel atau konten lainnya -->
    <p>Data Kelola Barang di sini...</p>
@endsection
