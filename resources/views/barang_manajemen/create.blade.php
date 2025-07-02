@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<h2>Form Tambah Barang</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('barang-manajemen.store-masuk') }}" method="POST">
    @csrf
    <div>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>
    </div>
    <div>
        <label>ID Barang Masuk:</label>
        <input type="text" name="id_barang_masuk" required>
    </div>
    <div>
        <label>Kode Barang:</label>
        <input type="text" name="kode_barang" required>
    </div>
    <div>
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required>
    </div>
    <div>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required min="1">
    </div>
    <div style="margin-top: 10px;">
        <button type="submit">Simpan</button>
    </div>
</form>
@endsection
