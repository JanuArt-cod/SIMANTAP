<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Mengizinkan field ini untuk diisi data secara massal (Mass Assignment)
    protected $fillable = [
        'name', 'slug'
    ];

    // Relasi ke tabel posts (1 Kategori memiliki banyak Post)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}