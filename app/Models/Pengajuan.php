<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_peminjaman',
        'id_peminjaman',
        'nama_peminjam',
        'nama_barang',
        'jumlah',
        'status_barang',
    ];
}
