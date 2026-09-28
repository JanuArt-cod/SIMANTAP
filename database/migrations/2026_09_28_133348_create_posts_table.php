<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('slug')->unique();
            
            // Relasi ke tabel categories
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            
            // Relasi ke tabel users (siapa yang menulis)
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
