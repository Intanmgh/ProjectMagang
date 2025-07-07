<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_peminjaman');
        $table->string('id_peminjaman');
        $table->string('nama_peminjam');
        $table->string('nama_barang');
        $table->integer('jumlah');
        $table->enum('status_barang', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
