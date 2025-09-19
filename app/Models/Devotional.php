<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devotional extends Model
{
    use SoftDeletes;

    protected $table = 'devotionals';

    protected $fillable = [
        'encrypted_id',
        'title',
        'slug_url',
        'description',
        'long_description',
        'page',
        'status'
    ];
}
