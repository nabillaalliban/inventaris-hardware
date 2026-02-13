<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            if (Schema::hasColumn('loan_requests','tipe_peminjam')) {
                $table->dropColumn('tipe_peminjam');
            }
            if (Schema::hasColumn('loan_requests','nama_peminjam')) {
                $table->dropColumn('nama_peminjam');
            }
            if (Schema::hasColumn('loan_requests','tanggal_pinjam')) {
                $table->dropColumn('tanggal_pinjam');
            }
        });
    }

    public function down(): void
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->string('tipe_peminjam')->nullable();
            $table->string('nama_peminjam')->nullable();
            $table->date('tanggal_pinjam')->nullable();
        });
    }
};

