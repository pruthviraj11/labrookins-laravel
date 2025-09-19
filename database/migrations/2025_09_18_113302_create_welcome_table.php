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
        Schema::create('welcome', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->longText('description');
            $table->string('image', 250);
            $table->string('text', 50);
            $table->string('url', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('welcome');
    }
};
