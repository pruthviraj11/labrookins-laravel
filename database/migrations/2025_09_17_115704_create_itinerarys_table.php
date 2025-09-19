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
        Schema::create('itinerarys', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('slug_url')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('time_from', 225)->nullable();
            $table->string('time_to', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('organizer_name', 255)->nullable();
            $table->string('organizer_email', 255)->nullable();
            $table->string('organizer_phone', 255)->nullable();
            $table->string('venue_name', 255)->nullable();
            $table->string('venue_phone', 255)->nullable();
            $table->text('venue_website')->nullable();
            $table->longText('venue_location')->nullable();
            $table->float('cost')->nullable();
            $table->text('website')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('itinerarys');
    }
};
