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
            Schema::create('loan_request_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('loan_request_id')->constrained('loan_requests')->onDelete('cascade');
        $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
        $table->unsignedInteger('qty');
        $table->timestamps();

        $table->index(['loan_request_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests_items');
    }
};
