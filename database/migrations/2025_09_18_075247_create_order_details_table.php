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
    Schema::create('order_details', function (Blueprint $table) {
      $table->id();
      $table->string('guest_id', 100)->nullable();
      $table->string('card_type', 50)->nullable();
      $table->string('card_number', 100)->nullable();
      $table->string('transaction_id', 200)->nullable();
      $table->string('auth_code', 255)->nullable();
      $table->string('response_code', 20)->nullable();
      $table->string('response_desc', 250)->nullable();
      $table->string('payment_response', 100)->nullable();
      $table->string('total_amount', 100)->nullable();
      $table->string('fname', 150)->nullable();
      $table->string('lname', 150)->nullable();
      $table->string('company_name', 150)->nullable();
      $table->string('country', 150)->nullable();
      $table->string('street_address1', 250)->nullable();
      $table->string('street_address2', 250)->nullable();
      $table->string('city', 150)->nullable();
      $table->string('state', 150)->nullable();
      $table->string('zip_code', 200)->nullable();
      $table->string('mobile', 150)->nullable();
      $table->string('email', 100)->nullable();
      $table->string('order_notes', 250)->nullable();
      $table->string('d_fname', 100)->nullable();
      $table->string('d_lname', 100)->nullable();
      $table->string('d_company_name', 100)->nullable();
      $table->string('d_country', 100)->nullable();
      $table->string('d_street_address1', 250)->nullable();
      $table->string('d_street_address2', 250)->nullable();
      $table->string('d_city', 100)->nullable();
      $table->string('d_state', 100)->nullable();
      $table->string('d_zip_code', 200)->nullable();
      $table->string('d_mobile', 100)->nullable();
      $table->string('d_email', 100)->nullable();
      $table->string('order_type', 50)->nullable();
      $table->string('ship_to_different_address', 45)->nullable();
      $table->tinyInteger('status')->default(1);
      $table->string('delivered', 45)->default('no');
      $table->timestamp('date_and_time')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('order_details');
  }
};
