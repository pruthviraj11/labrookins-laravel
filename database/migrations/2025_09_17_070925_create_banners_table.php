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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 225)->nullable();
            $table->string('button_text', 225)->nullable();
            $table->string('button_link', 225)->nullable();
            $table->string('slug_url', 225)->nullable();
            $table->string('sub_title', 100);
            $table->integer('is_page')->default(0);
            $table->string('order_by', 10);
            $table->text('image')->nullable();
            $table->string('page', 255)->nullable();
            $table->string('banner_start', 100);
            $table->string('banner_end', 100);
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('created_by')->nullable();
            $table->enum('is_deleted', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
