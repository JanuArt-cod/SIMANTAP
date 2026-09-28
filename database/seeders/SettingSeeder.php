<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'site_name'   => 'Portal Resmi Sekolah',
            'school_name' => 'MTSS SIROJUL ATHFAL',
            'logo'        => '',
            'email'       => 'info@mtssirojulathfal.com',
            'phone'       => '021-87654321',
            'address'     => 'Jl. Pendidikan No. 1, Kota Bogor, Jawa Barat'
        ]);
    }
}