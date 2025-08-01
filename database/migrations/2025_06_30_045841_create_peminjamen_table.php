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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nama_kegiatan');
            $table->string('ktm');
            $table->string('no_telp', 30);
            $table->string('email');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->string('upload_surat')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dikembalikan', 'ditolak'])->default('menunggu');
            $table->string('barang_dipinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
