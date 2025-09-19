<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    protected $table = 'schedulings';

    protected $fillable = [
        'name','position','ministry_name','pastor_name','address','city','state','zip',
        'email','office_phone','home_phone','mobile_phone','ministry_affilation',
        'event_name','event_type','theam','event_date','event_alternate_date','time_service',
        'event_location','additional_preferance','total_days_service','best_time_reach'
    ];

    protected $dates = ['event_date','event_alternate_date','created_at','updated_at'];
}

