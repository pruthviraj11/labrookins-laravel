<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
  use SoftDeletes;

  protected $table = 'itinerarys';

  protected $fillable = [
    'title',
    'slug_url',
    'description',
    'image',
    'time_from',
    'time_to',
    'start_date',
    'end_date',
    'organizer_name',
    'organizer_email',
    'organizer_phone',
    'venue_name',
    'venue_phone',
    'venue_website',
    'venue_location',
    'cost',
    'website',
    'status',
    'created_by',
    'updated_by',
    'deleted_by'
  ];
}
