<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'school_name',
        'logo',
        'email',
        'phone',
        'address',
        'facebook',   // <-- Tambahkan ini
        'instagram',  // <-- Tambahkan ini
        'youtube',    // <-- Tambahkan ini
        'tiktok',     // <-- Tambahkan ini
        'welcome_title',
        'welcome_text',
        'welcome_image',
        'welcome_name',
        'welcome_position',
        'posts_limit'
    ];
}