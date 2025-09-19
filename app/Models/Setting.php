<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'email', 'contact', 'website_title', 'template_skin', 'logo',
        'smtp_email', 'smtp_pass', 'address',
        'facebook', 'twitter', 'instagram', 'youtube',
        'prayer_request_email', 'contact_form', 'user_nicename',
        'image', 'scheduling_email'
    ];
}
