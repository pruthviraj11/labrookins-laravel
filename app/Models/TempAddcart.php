<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempAddcart extends Model
{
    use HasFactory;

    protected $table = 'temp_addcart';

    protected $fillable = [
        'encrypted_id',
        'guest_id',
        'product_id',
        'quntity',
        'price',
        'totalAmount',
        'date',
        'order_status',
        'order_date',
    ];
}
