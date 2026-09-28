<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'title', 'slug', 'category_id', 'user_id', 'content'
    ];

    // Relasi ke Category (1 Post hanya memiliki 1 Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke User (1 Post ditulis oleh 1 User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-Many ke Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}