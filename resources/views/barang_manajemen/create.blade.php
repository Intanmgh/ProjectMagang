@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
    <h2 class="page-title">Tambah Barang Masuk</h2>

    @if($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang-manajemen.store-masuk') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="tanggal">Tanggal:</label><br>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        {{-- ID Barang Masuk akan otomatis digenerate di controller --}}

        <div style="margin-bottom: 10px;">
            <label for="kode_barang">Kode Barang:</label><br>
            <input type="text" id="kode_barang" name="kode_barang" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="nama_barang">Nama Barang:</label><br>
            <input type="text" id="nama_barang" name="nama_barang" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="jumlah">Jumlah:</label><br>
            <input type="number" id="jumlah" name="jumlah" required min="1">
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #388E3C; color: white; border: none; border-radius: 5px;">
            Simpan Barang Masuk
        </button>
    </form>
@endsection
