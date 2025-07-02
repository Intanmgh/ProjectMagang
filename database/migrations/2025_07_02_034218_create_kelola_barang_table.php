<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelolaBarangTable extends Migration
{
    public function up()
    {
        Schema::create('kelola_barang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('id_barang_masuk')->unique();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('status')->nullable();  // Optional: untuk status barang
            $table->string('lokasi')->nullable();  // Optional: lokasi penyimpanan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelola_barang');
    }
}
