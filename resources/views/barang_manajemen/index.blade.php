@extends('layouts.app')

@section('title', 'Manajemen Barang')
@section('content')
<h2 class="page-title">Kelola Barang</h2>

<div id="data-barang-tab" class="tab-content active"> 
    <h3>Data Barang (Tabel)</h3>

    <div class="table-header-actions" style="margin-bottom: 20px;">
        <a href="{{ route('barang-manajemen.create') }}" class="btn-submit" style="background-color: #388E3C; color: white; padding: 10px 16px; border-radius: 5px; text-decoration: none;">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>ID Barang</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <!-- <th>Status</th> -->
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataBarang as $item)
            <tr>
                <td data-label="Tanggal">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td data-label="ID Barang">{{ $item->id_barang_masuk }}</td>
                <td data-label="Kode Barang">{{ $item->kode_barang }}</td>
                <td data-label="Nama Barang">{{ $item->nama_barang }}</td>
                <!-- <td data-label="Status">{{ $item->status ?? '-' }}</td> -->
                <td data-label="Jumlah">{{ $item->jumlah }}</td>
                <td data-label="Aksi">
                    <a href="{{ route('barang-manajemen.edit', $item->id) }}" class="btn-action-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('barang-manajemen.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action-delete" onclick="return confirm('Yakin ingin menghapus barang ini?');">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-section">
        <div class="pagination-info">
            Showing {{ $dataBarang->firstItem() }} to {{ $dataBarang->lastItem() }} of {{ $dataBarang->total() }} entries
        </div>
        <div class="pagination-controls">
            @if ($dataBarang->hasPages())
                <nav class="flex justify-center mt-4">
                    <ul class="inline-flex items-center space-x-1">
                        @if ($dataBarang->onFirstPage())
                            <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">← Prev</li>
                        @else
                            <li>
                                <a href="{{ $dataBarang->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">← Prev</a>
                            </li>
                        @endif

                        @foreach ($dataBarang->elements() as $element)
                            @if (is_string($element))
                                <li class="px-3 py-1 text-gray-500">...</li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $dataBarang->currentPage())
                                        <li class="px-3 py-1 text-white bg-blue-500 border border-blue-500 rounded">{{ $page }}</li>
                                    @else
                                        <li>
                                            <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($dataBarang->hasMorePages())
                            <li>
                                <a href="{{ $dataBarang->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-100">Next →</a>
                            </li>
                        @else
                            <li class="px-3 py-1 text-gray-400 border border-gray-300 rounded">Next →</li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

<style>
.data-table {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 20px;
}

.data-table thead {
  background-color: #388E3C;
  color: white;
  text-align: left;
}

.data-table th, 
.data-table td {
  padding: 12px 15px;
  border: 1px solid #ddd;
}

.data-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.data-table tbody tr:hover {
  background-color: #d6f0d6;
}

.btn-action-edit,
.btn-action-delete {
  cursor: pointer;
  padding: 6px 10px;
  border: none;
  border-radius: 4px;
  font-size: 0.9rem;
  transition: background-color 0.3s ease;
  color: white;
}

.btn-action-edit {
  background-color: #2e7d32;
  margin-right: 5px;
}

.btn-action-edit:hover {
  background-color: #1b4d1b;
}

.btn-action-delete {
  background-color: #d32f2f;
}

.btn-action-delete:hover {
  background-color: #8b1a1a;
}

.btn-submit {
  font-weight: 600;
  box-shadow: 0 3px 6px rgba(56, 142, 60, 0.5);
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #2e7d32;
  box-shadow: 0 4px 8px rgba(46, 125, 50, 0.6);
}
</style>

@push('scripts')
<script>
    // JavaScript untuk fungsionalitas tab (jika ada tab lain)
    document.addEventListener('DOMContentLoaded', function() {
        const tabHeaders = document.querySelectorAll('.tab-header');
        const tabContents = document.querySelectorAll('.tab-content');

        tabHeaders.forEach(header => {
            header.addEventListener('click', function() {
                tabHeaders.forEach(h => h.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                const targetTabId = this.dataset.tab;
                document.getElementById(targetTabId).classList.add('active');
            });
        });
    });
</script>
@endpush
@endsection
