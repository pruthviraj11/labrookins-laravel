<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'encrypted_id',
        'title',
        'slug_url',
        'is_active',
        'is_deleted',
    ];
}
