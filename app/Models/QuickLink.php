<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    protected $fillable = [
        'title1', 'image1', 'url1',
        'title2', 'image2', 'url2',
        'title3', 'image3', 'url3',
        'title4', 'image4', 'url4',
    ];
}
