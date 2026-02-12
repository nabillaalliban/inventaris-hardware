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
            Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('nama_barang');
        $table->unsignedBigInteger('harga')->default(0);
        $table->unsignedInteger('stok')->default(0);
        $table->date('tanggal')->nullable(); // tanggal input
        $table->string('foto')->nullable(); // path foto
        $table->timestamps();

        $table->index(['category_id', 'nama_barang']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
