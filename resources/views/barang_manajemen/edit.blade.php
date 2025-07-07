@extends('layouts.app')

@section('content')
<div class="breadcrumb-container">
    <span class="breadcrumb-item">Kelola</span>
    <span class="breadcrumb-item">/</span>
    <span class="breadcrumb-item"><a href="{{ route('barang-manajemen.index') }}">Kelola Barang</a></span>
    <span class="breadcrumb-item">/</span>
    <span class="breadcrumb-item active">Edit Barang</span>
</div>

<h2 class="page-title">Edit Data Barang</h2>

<div class="form-container">
    <form action="{{ route('barang-manajemen.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-grid">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="id_barang_masuk">ID Barang Masuk</label>
                <input type="text" id="id_barang_masuk" name="id_barang_masuk" value="{{ old('id_barang_masuk', $item->id_barang_masuk) }}" required>
            </div>

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $item->jumlah) }}" min="1" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <a href="{{ route('barang-manajemen.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .breadcrumb-container {
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        margin-bottom: 20px;
        color: #555;
    }

    .breadcrumb-container a {
        color: #388E3C;
        text-decoration: none;
    }

    .breadcrumb-container .breadcrumb-item.active {
        font-weight: bold;
        color: #000;
    }

    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #333;
    }

    .form-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px 35px;
        max-width: 700px;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        font-family: 'Poppins', sans-serif;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #222;
    }

    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: 0.3s ease;
    }

    .form-group input:focus {
        border-color: #4CAF50;
        outline: none;
        box-shadow: 0 0 6px rgba(76, 175, 80, 0.2);
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        gap: 12px;
    }

    .btn-submit {
        background-color: #388E3C;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #2e7d32;
    }

    .btn-cancel {
        background-color: #ccc;
        color: #333;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: #b3b3b3;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .alert.error {
        background-color: #ffe8e8;
        border: 1px solid #e74c3c;
        color: #a94442;
    }

    .alert.success {
        background-color: #e8fbe8;
        border: 1px solid #2ecc71;
        color: #2d862d;
    }

    @media (max-width: 600px) {
        .form-container {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush
