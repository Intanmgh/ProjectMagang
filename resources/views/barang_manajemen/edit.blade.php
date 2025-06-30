@extends('layouts.app')

@section('content')
<div class="breadcrumb-container">
    <span class="breadcrumb-item">Manajemen</span>
    <span class="breadcrumb-item">/</span>
    <span class="breadcrumb-item"><a href="{{ route('barang-manajemen.index') }}">Manajemen Barang</a></span>
    <span class="breadcrumb-item">/</span>
    <span class="breadcrumb-item active">Edit Barang</span>
</div>

<h2 class="page-title">Edit Data Barang</h2>

<div class="table-card"> {{-- Menggunakan kelas table-card untuk styling --}}
    <form action="{{ route('barang-manajemen.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting untuk method PUT --}}

        @if ($errors->any())
            <div style="background-color: #ffe0e0; border: 1px solid #ff0000; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div style="background-color: #e0ffe0; border: 1px solid #00ff00; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d')) }}" required>
        </div>
        <div class="form-group">
            <label for="id_barang_masuk">ID Barang Masuk:</label>
            <input type="text" id="id_barang_masuk" name="id_barang_masuk" value="{{ old('id_barang_masuk', $item->id_barang_masuk) }}" required>
        </div>
        <div class="form-group">
            <label for="kode_barang">Kode Barang:</label>
            <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" required>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $item->jumlah) }}" min="1" required>
        </div>
        {{-- Tambahkan field untuk status dan lokasi jika Anda sudah menambahkannya di migrasi dan model --}}
        {{--
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" value="{{ old('status', $item->status) }}">
        </div>
        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $item->lokasi) }}">
        </div>
        --}}
        <button type="submit" class="btn-submit">Perbarui Data</button>
        <a href="{{ route('barang-manajemen.index') }}" class="btn-add-transaction" style="background-color: #6c757d; margin-left: 10px;">Batal</a>
    </form>
</div>
@endsection
