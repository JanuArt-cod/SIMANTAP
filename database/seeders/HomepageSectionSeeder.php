<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['name' => 'Slider Banner', 'key' => 'slider', 'order' => 1, 'is_active' => true],
            ['name' => 'Sambutan Kepala Sekolah', 'key' => 'welcome', 'order' => 2, 'is_active' => true],
            ['name' => 'Agenda & Kegiatan', 'key' => 'agendas', 'order' => 3, 'is_active' => true],
            ['name' => 'Berita Terbaru', 'key' => 'posts', 'order' => 4, 'is_active' => true],
            ['name' => 'Pengumuman Resmi', 'key' => 'announcements', 'order' => 5, 'is_active' => true], // <-- Ditambahkan di sini
            ['name' => 'Galeri Foto & Video', 'key' => 'galleries', 'order' => 6, 'is_active' => true],
        ];

        foreach ($sections as $section) {
            HomepageSection::firstOrCreate(
                ['key' => $section['key']], 
                $section
            );
        }
    }
}