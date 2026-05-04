<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'subtitle', 'about_text',
        'hero_image', 'profile_image', 'logo_image', 'cv_file',
        'email', 'phone', 'skills_headline',
        'instagram', 'facebook', 'twitter', 'youtube', 'github',
        'is_active'
    ];
}
