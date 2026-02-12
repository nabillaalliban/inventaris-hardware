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
            Schema::create('loan_requests', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // pengaju (akun user)
        $table->enum('tipe_peminjam', ['mahasiswa','dosen','bidang1','bidang2','bidang3']);
        $table->string('nama_peminjam');

        $table->date('tanggal_pinjam');
        $table->date('due_date')->nullable();
        $table->date('tanggal_kembali')->nullable();

        $table->text('catatan')->nullable();

        $table->enum('status', ['pending','approved','rejected','returned'])->default('pending');
        $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // admin
        $table->timestamp('approved_at')->nullable();

        $table->timestamps();

        $table->index(['status', 'due_date']);
        $table->index(['user_id', 'status']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};
