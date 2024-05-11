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
        Schema::create('daftar_bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku');
            $table->string('image_buku');
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('kategori_buku_id')->nullable();
            $table->string('file_buku');
            $table->date('tanggal_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_bukus');
    }
};
