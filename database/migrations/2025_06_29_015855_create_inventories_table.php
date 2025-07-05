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
        Schema::create('inventori', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('gambar_barang');
            $table->text('deskripsi')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->integer('jumlah')->default(0);
            $table->string('lokasi')->nullable();
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventori');
    }
};
