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
        Schema::create('home_links', function (Blueprint $table) {
            $table->id();
            $table->string('title1', 100)->nullable();
            $table->string('url1', 100)->nullable();
            $table->string('title2', 100)->nullable();
            $table->string('url2', 100)->nullable();
            $table->string('title3', 100)->nullable();
            $table->string('url3', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_links');
    }
};
