<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
  use SoftDeletes;
  protected $table = 'order_details';

  protected $fillable = [
    'guest_id',
    'card_type',
    'card_number',
    'transaction_id',
    'auth_code',
    'response_code',
    'response_desc',
    'payment_response',
    'total_amount',
    'fname',
    'lname',
    'company_name',
    'country',
    'street_address1',
    'street_address2',
    'city',
    'state',
    'zip_code',
    'mobile',
    'email',
    'order_notes',
    'd_fname',
    'd_lname',
    'd_company_name',
    'd_country',
    'd_street_address1',
    'd_street_address2',
    'd_city',
    'd_state',
    'd_zip_code',
    'd_mobile',
    'd_email',
    'order_type',
    'ship_to_different_address',
    'status',
    'delivered',
    'date_and_time',
    'deleted_at'
  ];
}
