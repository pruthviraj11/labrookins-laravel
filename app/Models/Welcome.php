<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    protected $table = 'welcome';

    protected $fillable = [
        'title',
        'description',
        'image',
        'text',
        'url',
    ];
}

