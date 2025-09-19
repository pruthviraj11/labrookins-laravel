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
         Schema::create('quick_links', function (Blueprint $table) {
            $table->id();
            $table->string('title1', 50);
            $table->string('image1', 250);
            $table->string('url1', 250);
            $table->string('title2', 50);
            $table->string('image2', 250);
            $table->string('url2', 50);
            $table->string('title3', 50);
            $table->string('image3', 250);
            $table->string('url3', 50);
            $table->string('title4', 100)->nullable();
            $table->string('url4', 100)->nullable();
            $table->string('image4', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_links');
    }
};
