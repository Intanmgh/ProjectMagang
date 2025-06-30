@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

@section('content')
<div class="breadcrumb-container">
    <span class="breadcrumb-item">Manajemen</span>
    <span class="breadcrumb-item">/</span>
    <span class="breadcrumb-item active">Manajemen Barang</span>
</div>

<h2 class="page-title">Manajemen Barang</h2>

<div class="tab-container">
    <div class="tab-headers">
        <div class="tab-header active" data-tab="barang-masuk-tab">Barang Masuk</div>
        <div class="tab-header" data-tab="barang-keluar-tab">Barang Keluar</div>
        <div class="tab-header" data-tab="update-barang-tab">Update Barang</div>
        <div class="tab-header" data-tab="data-barang-tab">Data Barang</div>
    </div>

    <div id="barang-masuk-tab" class="tab-content active">
        <h3>Form Barang Masuk</h3>
        <form action="{{ url('/barang-manajemen/store-masuk') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal:</label>
                <input type="date" id="tanggal_masuk" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="id_barang_masuk">ID Barang Masuk:</label>
                <input type="text" id="id_barang_masuk" name="id_barang_masuk" placeholder="Contoh: M001" required>
            </div>
            <div class="form-group">
                <label for="kode_barang_masuk">Kode Barang:</label>
                <input type="text" id="kode_barang_masuk" name="kode_barang" placeholder="Contoh: BRG001" required>
            </div>
            <div class="form-group">
                <label for="nama_barang_masuk">Nama Barang:</label>
                <input type="text" id="nama_barang_masuk" name="nama_barang" placeholder="Contoh: Mesin Cuci" required>
            </div>
            <div class="form-group">
                <label for="jumlah_masuk">Jumlah:</label>
                <input type="number" id="jumlah_masuk" name="jumlah" min="1" required>
            </div>
            <button type="submit" class="btn-submit">Simpan Barang Masuk</button>
        </form>
    </div>

    <div id="barang-keluar-tab" class="tab-content">
        <h3>Form Barang Keluar</h3>
        <form action="{{ url('/barang-manajemen/store-keluar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" id="tanggal_keluar" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="id_barang_keluar">ID Barang Keluar:</label>
                <input type="text" id="id_barang_keluar" name="id_barang_keluar" placeholder="Contoh: K001" required>
            </div>
            <div class="form-group">
                <label for="kode_barang_keluar">Kode Barang:</label>
                <input type="text" id="kode_barang_keluar" name="kode_barang" placeholder="Contoh: BRG001" required>
            </div>
            <div class="form-group">
                <label for="jumlah_keluar">Jumlah Keluar:</label>
                <input type="number" id="jumlah_keluar" name="jumlah" min="1" required>
            </div>
            <div class="form-group">
                <label for="tujuan_keluar">Tujuan:</label>
                <input type="text" id="tujuan_keluar" name="tujuan" placeholder="Contoh: Produksi A" required>
            </div>
            <button type="submit" class="btn-submit">Proses Barang Keluar</button>
        </form>
    </div>

    <div id="update-barang-tab" class="tab-content">
        <h3>Update Status Barang</h3>
        <form action="{{ url('/barang-manajemen/update-status') }}" method="POST">
            @csrf
            @method('PUT') {{-- Gunakan method PUT untuk update --}}
            <div class="form-group">
                <label for="id_barang_update">ID Barang (untuk diupdate):</label>
                <input type="text" id="id_barang_update" name="id_barang" placeholder="Contoh: M001 atau K001" required>
            </div>
            <div class="form-group">
                <label for="status_baru">Status Baru:</label>
                <select id="status_baru" name="status_baru" required>
                    <option value="">Pilih Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                    <option value="Dibuang">Dibuang</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi_baru">Lokasi Baru (Opsional):</label>
                <input type="text" id="lokasi_baru" name="lokasi_baru" placeholder="Contoh: Gudang B, Rak 3">
            </div>
            <button type="submit" class="btn-submit">Perbarui Status</button>
        </form>
    </div>

    <div id="data-barang-tab" class="tab-content">
        <h3>Data Barang (Tabel)</h3>
        <div class="table-controls">
            <div class="table-controls-left">
                <label for="showEntriesData">Show</label>
                <select id="showEntriesData">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>entries</span>
            </div>
            <div class="table-controls-right">
                <label for="searchTableData">Search:</label>
                <input type="search" id="searchTableData" placeholder="">
            </div>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>ID Transaksi</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    {{-- Tambahkan kolom Jenis Transaksi jika model Anda mendukung --}}
                    {{-- <th>Jenis Transaksi</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataBarang as $item)
                <tr>
                    <td data-label="Tanggal">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td data-label="ID Transaksi">{{ $item->id_barang_masuk ?? $item->id_barang_keluar ?? $item->id }}</td>
                    <td data-label="Kode Barang">{{ $item->kode_barang }}</td>
                    <td data-label="Nama Barang">{{ $item->nama_barang }}</td>
                    <td data-label="Jumlah">{{ $item->jumlah }}</td>
                    {{-- Asumsikan kolom 'jenis_transaksi' ada di model Anda jika ingin menampilkan --}}
                    {{-- <td data-label="Jenis Transaksi">{{ $item->jenis_transaksi ?? '-' }}</td> --}}
                    <td data-label="Aksi">
                        <a href="{{ route('barang-manajemen.edit', $item->id) }}" class="btn-action-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('barang-manajemen.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data barang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-section">
    <div class="pagination-info">
        Showing {{ $dataBarang->firstItem() }} to {{ $dataBarang->lastItem() }} of {{ $dataBarang->total() }} entries
    </div>
    <div class="pagination-controls">
        {{-- Pagination Custom langsung di sini --}}
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


@push('scripts')
<script>
    // JavaScript untuk fungsionalitas tab
    document.addEventListener('DOMContentLoaded', function() {
        const tabHeaders = document.querySelectorAll('.tab-header');
        const tabContents = document.querySelectorAll('.tab-content');

        tabHeaders.forEach(header => {
            header.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua header dan konten
                tabHeaders.forEach(h => h.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Tambahkan kelas 'active' ke header yang diklik
                this.classList.add('active');

                // Tampilkan konten tab yang sesuai
                const targetTabId = this.dataset.tab;
                document.getElementById(targetTabId).classList.add('active');
            });
        });

        // Aktifkan tab pertama secara default saat halaman dimuat
        // Atau aktifkan tab 'Data Barang' jika Anda ingin itu default
        // Untuk default 'Barang Masuk', biarkan seperti ini:
        if (tabHeaders.length > 0 && tabContents.length > 0) {
            tabHeaders[0].classList.add('active');
            tabContents[0].classList.add('active');
        }

        // Jika Anda ingin tab 'Data Barang' yang aktif secara default, ganti ini:
        // const defaultTab = document.querySelector('.tab-header[data-tab="data-barang-tab"]');
        // const defaultContent = document.getElementById('data-barang-tab');
        // if (defaultTab && defaultContent) {
        //     defaultTab.classList.add('active');
        //     defaultContent.classList.add('active');
        // }
    });
</script>
@endpush
