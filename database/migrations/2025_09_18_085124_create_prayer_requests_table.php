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
         Schema::create('prayer_requests', function (Blueprint $table) {
        $table->id();
        $table->string('category', 20)->nullable();
        $table->string('subject', 150)->nullable();
        $table->string('need_prayer_name', 100)->nullable();
        $table->string('prayer_church_member', 100)->nullable();
        $table->string('requested_name', 100)->nullable();
        $table->string('phone_no_type_one', 30)->nullable();
        $table->string('mobile_one', 20)->nullable();
        $table->string('phone_no_type_two', 50)->nullable();
        $table->string('mobile_two', 20)->nullable();
        $table->string('email', 50)->nullable();
        $table->string('requested_church_member', 20)->nullable();
        $table->string('message', 250)->nullable();
        $table->tinyInteger('status')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_requests');
    }
};
