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
        Schema::create('temp_addcart', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id', 250)->nullable();
            $table->string('guest_id', 20)->nullable();
            $table->string('product_id', 10)->nullable();
            $table->string('quntity', 20)->nullable();
            $table->string('price', 20)->nullable();
            $table->string('totalAmount', 20)->nullable();
            $table->date('date')->nullable();
            $table->enum('order_status', ['pending', 'completed'])->nullable();
            $table->string('order_date', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_addcart');
    }
};
