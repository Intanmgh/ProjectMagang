<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    protected $fillable = ['kode_barang', 'nama_barang', 'stok'];
}
