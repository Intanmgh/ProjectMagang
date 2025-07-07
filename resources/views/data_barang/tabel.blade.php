@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <h2 style="font-weight: 700; color:rgb(0, 0, 0);">Data Barang</h2>

    <div style="overflow-x:auto; margin-top: 20px;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataBarang as $barang)
                    <tr>
                        <td data-label="Kode Barang">{{ $barang->kode_barang }}</td>
                        <td data-label="Nama Barang">{{ $barang->nama_barang }}</td>
                        <td data-label="Stok">{{ $barang->stok }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 20px; color: #777;">
                            Data barang belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .data-table thead {
            background-color: #388E3C;
            color: white;
        }

        .data-table th, .data-table td {
            padding: 14px 18px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 0.95rem;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .data-table tbody tr:hover {
            background-color: #e8f5e9;
        }

        @media (max-width: 768px) {
            .data-table thead {
                display: none;
            }

            .data-table, .data-table tbody, .data-table tr, .data-table td {
                display: block;
                width: 100%;
            }

            .data-table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
            }

            .data-table td {
                padding: 12px;
                text-align: right;
                position: relative;
                border-bottom: 1px solid #ddd;
            }

            .data-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 12px;
                font-weight: bold;
                color: #388E3C;
                text-align: left;
            }
        }
    </style>
@endsection
