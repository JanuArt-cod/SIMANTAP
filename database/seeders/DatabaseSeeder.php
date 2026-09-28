<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder secara berurutan
        $this->call([
            RolesPermissionsSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            HomepageSectionSeeder::class,
        ]);
    }
}