<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id(); // id (primary key)

            $table->string('tipe_peminjaman');
            $table->string('nama_peminjam');

            $table->unsignedBigInteger('inventaris_id');
            $table->date('tanggal_pinjam');
            $table->text('keterangan')->nullable();

            $table->string('status');
            $table->date('tanggal_kembali')->nullable();
            $table->text('keterangan_kembali')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->timestamps(); // created_at & updated_at

            $table->foreign('inventaris_id')->references('id')->on('inventaris')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
