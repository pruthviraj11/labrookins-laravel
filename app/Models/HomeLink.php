<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeLink extends Model
{
  protected $table = 'home_links';

  protected $fillable = [
    'title1',
    'url1',
    'title2',
    'url2',
    'title3',
    'url3',
  ];
}
