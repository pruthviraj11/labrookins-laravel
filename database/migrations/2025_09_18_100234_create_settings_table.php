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
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->string('email', 100)->nullable();
      $table->string('contact', 20)->nullable();
      $table->string('website_title', 200)->nullable();
      $table->string('template_skin', 50)->nullable();
      $table->string('logo', 200)->nullable();
      $table->string('smtp_email', 100)->nullable();
      $table->string('smtp_pass', 100)->nullable();
      $table->text('address')->nullable();
      $table->text('facebook')->nullable();
      $table->text('twitter')->nullable();
      $table->text('instagram')->nullable();
      $table->text('youtube')->nullable();
      $table->string('prayer_request_email', 225)->nullable();
      $table->string('contact_form', 225)->nullable();
      $table->text('user_nicename')->nullable();
      $table->string('image', 255)->nullable();
      $table->string('scheduling_email', 255)->nullable();
      $table->timestamps();
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('settings');
  }
};
