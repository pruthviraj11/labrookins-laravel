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
        Schema::create('schedulings', function (Blueprint $table) {
             $table->id();
            $table->string('name', 100)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('ministry_name', 150)->nullable();
            $table->string('pastor_name', 100)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('office_phone', 30)->nullable();
            $table->string('home_phone', 30)->nullable();
            $table->string('mobile_phone', 30)->nullable();
            $table->string('ministry_affilation', 250)->nullable();
            $table->string('event_name', 150)->nullable();
            $table->string('event_type', 100)->nullable();
            $table->string('theam', 100)->nullable();
            $table->date('event_date')->nullable();
            $table->date('event_alternate_date')->nullable();
            $table->string('time_service', 100)->nullable();
            $table->string('event_location', 250)->nullable();
            $table->string('additional_preferance', 200)->nullable();
            $table->string('total_days_service', 50)->nullable();
            $table->string('best_time_reach', 150)->nullable();
            $table->timestamps(); // includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedulings');
    }
};
