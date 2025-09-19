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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id', 250)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('slug_url', 150)->nullable()->unique();
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->enum('is_deleted', ['no', 'yes'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
