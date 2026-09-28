<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cache roles dan permissions dari Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat daftar Permissions (Hak Akses)
        $permissions = [
            'dashboard.index',
            'roles.index', 'roles.create', 'roles.edit', 'roles.delete',
            'users.index', 'users.create', 'users.edit', 'users.delete',
            'posts.index', 'posts.create', 'posts.edit', 'posts.delete',
            'agendas.index', 'agendas.create', 'agendas.edit', 'agendas.delete',
        ];

        // Looping untuk memasukkan permission ke database
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 2. Buat Role (Peran) 'admin'
        $roleAdmin = Role::create(['name' => 'admin']);

        // 3. Berikan semua hak akses (permissions) ke role 'admin'
        $roleAdmin->givePermissionTo(Permission::all());
    }
}