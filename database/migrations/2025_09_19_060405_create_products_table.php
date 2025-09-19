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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id', 250)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('product_name', 200)->nullable();
            $table->longText('product_description')->nullable();
            $table->string('product_image', 250)->nullable();
            $table->string('product_price', 50)->nullable();
            $table->string('product_discount_price', 50)->nullable();
            $table->string('download_document', 250)->nullable();
            $table->enum('product_digital', ['yes', 'no'])->default('no');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
