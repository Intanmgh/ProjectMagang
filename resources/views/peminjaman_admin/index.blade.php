@extends('layouts.app')

@section('title', 'Peminjaman Admin')

@section('content')
    <h2 class="page-title">Peminjaman Admin</h2>

    <table class="table-peminjaman">
        <thead>
            <tr>
                <th>Tanggal Peminjaman</th>
                <th>ID Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
                <th>Status Barang</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>{{ $item->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <style>
        .table-peminjaman {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
            margin-top: 20px;
        }

        .table-peminjaman thead {
            background-color: #388E3C;
            color: white;
        }

        .table-peminjaman th, .table-peminjaman td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .table-peminjaman tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-peminjaman tbody tr:hover {
            background-color: #e0f2e0;
        }

        .btn-edit, .btn-delete {
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .btn-edit {
            background-color: #1976D2;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background-color: #0D47A1;
        }

        .btn-delete {
            background-color: #D32F2F;
        }

        .btn-delete:hover {
            background-color: #B71C1C;
        }
    </style>
@endsection
