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
         Schema::create('cart_items', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
        $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
        $table->unsignedInteger('qty')->default(1);
        $table->timestamps();

        $table->unique(['cart_id','item_id']); // biar item ga dobel, tinggal update qty
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_items');
    }
};
