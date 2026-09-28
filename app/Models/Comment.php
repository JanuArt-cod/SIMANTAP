<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'name',
        'email',
        'comment',
        'is_approved' // <-- Tambahkan ini
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}