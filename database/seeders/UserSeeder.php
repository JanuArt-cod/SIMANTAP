<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Untuk mengenkripsi password

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat data user baru
        $admin = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@tes.id',
            'password'  => Hash::make('admin'), // Passwordnya adalah: password123
        ]);

        // 2. Memberikan Role 'admin' kepada user tersebut
        // Fitur assignRole ini berasal dari Spatie yang kita pasang di Bab 3
        $admin->assignRole('admin');
    }
}