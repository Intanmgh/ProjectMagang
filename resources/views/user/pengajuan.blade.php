@extends('layouts.app-user')

@section('navbar-title', 'Pengajuan Barang')

@section('content')
    <h2>Pengajuan Peminjaman Barang</h2>

    {{-- Tombol untuk membuka modal --}}
    <button onclick="openModal()" style="padding: 10px 20px; background-color: #388E3C; color: white; border: none; border-radius: 5px; font-weight: bold;">Ajukan Barang</button>

    {{-- Modal Form --}}
    <div id="formModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div style="background: white; padding: 20px; margin: 100px auto; width: 400px; border-radius: 10px; position: relative;">
            <h3>Form Pengajuan</h3>
            <form action="{{ route('user.pengajuan.store') }}" method="POST">
                @csrf
                <label>Tanggal Peminjaman</label>
                <input type="date" name="tanggal_peminjaman" required><br><br>

                <label>Nama Peminjam</label>
                <input type="text" name="nama_peminjam" required><br><br>

                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required><br><br>

                <label>Jumlah</label>
                <input type="number" name="jumlah" min="1" required><br><br>

                <button type="submit" style="background-color: #388E3C; color: white; border: none; padding: 8px 16px; border-radius: 4px;">Kirim</button>
                <button type="button" onclick="closeModal()" style="margin-left: 10px; padding: 8px 16px;">Batal</button>
            </form>
        </div>
    </div>

    {{-- Tabel daftar pengajuan --}}
    <table style="margin-top: 30px; width: 100%; border-collapse: collapse; text-align: center;">
        <thead style="background-color: #388E3C; color: white;">
            <tr>
                <th style="padding: 12px; border: 1px solid #ccc;">Tanggal Peminjaman</th>
                <th style="padding: 12px; border: 1px solid #ccc;">ID Peminjaman</th>
                <th style="padding: 12px; border: 1px solid #ccc;">Nama Peminjam</th>
                <th style="padding: 12px; border: 1px solid #ccc;">Nama Barang</th>
                <th style="padding: 12px; border: 1px solid #ccc;">Jumlah</th>
                <th style="padding: 12px; border: 1px solid #ccc;">Status Barang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuans as $data)
                <tr style="background-color: #fff;">
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $data->tanggal_peminjaman }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $data->id_peminjaman }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $data->nama_peminjam }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $data->nama_barang }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $data->jumlah }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        @if ($data->status_barang === 'menunggu')
                            <span style="background-color: #ffc107; color: black; padding: 5px 15px; border-radius: 20px; font-size: 13px;">Menunggu</span>
                        @elseif ($data->status_barang === 'disetujui')
                            <span style="background-color: #28a745; color: white; padding: 5px 15px; border-radius: 20px; font-size: 13px;">Disetujui</span>
                        @elseif ($data->status_barang === 'ditolak')
                            <span style="background-color: #dc3545; color: white; padding: 5px 15px; border-radius: 20px; font-size: 13px;">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; border: 1px solid #ccc;">Belum ada pengajuan barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- JavaScript --}}
    <script>
        function openModal() {
            document.getElementById('formModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('formModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('formModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
