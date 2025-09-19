<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'encrypted_id',
        'category_id',
        'product_name',
        'product_description',
        'product_image',
        'product_price',
        'product_discount_price',
        'download_document',
        'product_digital',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
