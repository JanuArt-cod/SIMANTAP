<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nama tampilan (Contoh: Slider Banner, Sambutan, Agenda, Berita, Galeri)
            $table->string('key');           // Kode unik (slider, welcome, posts, agendas, galleries)
            $table->integer('order')->default(0); // Nomor urut prioritas tampil
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};