<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category',
        'subject',
        'need_prayer_name',
        'prayer_church_member',
        'requested_name',
        'phone_no_type_one',
        'mobile_one',
        'phone_no_type_two',
        'mobile_two',
        'email',
        'requested_church_member',
        'message',
        'status',
        'deleted_at'
    ];
}
