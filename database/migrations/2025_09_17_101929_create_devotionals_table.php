<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('devotionals', function (Blueprint $table) {
      $table->id();
      $table->string('encrypted_id', 250)->nullable();
      $table->string('title', 100)->nullable();
      $table->string('slug_url', 250)->nullable();
      $table->longText('description')->nullable();
      $table->longText('long_description')->nullable();
      $table->string('page', 50)->nullable();
      $table->tinyInteger('status')->default(1);
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('devotionals');
  }
};
