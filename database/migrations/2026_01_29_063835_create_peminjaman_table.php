<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->enum('tipe_peminjam', ['mahasiswa', 'dosen', 'bidang1', 'bidang2', 'bidang3']);
            $table->string('nama_peminjam');

            $table->foreignId('inventaris_id')->constrained('inventaris')->onDelete('cascade');

            $table->date('tanggal_pinjam');
            $table->text('keterangan')->nullable();

            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->text('keterangan_kembali')->nullable();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
