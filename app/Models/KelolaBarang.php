<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaBarang extends Model
{
    use HasFactory;

    protected $table = 'kelola_barang';

    protected $fillable = [
        'tanggal',
        'id_barang_masuk',
        'kode_barang',
        'nama_barang',
        'jumlah',
        'status',
        'lokasi',
    ];
}
