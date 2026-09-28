<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    // 1. Menampilkan Form Tambah Role
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // 2. Menyimpan Role Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        // Buat role baru
        $role = Role::create(['name' => $request->name]);

        // Sinkronkan (berikan) permissions yang dicentang ke role tersebut
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Data Role Berhasil Disimpan!');
    }

    // 3. Menampilkan Form Edit Role
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // 4. Memperbarui Data Role di Database
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        // Update nama role
        $role->update(['name' => $request->name]);

        // Update permissions yang dicentang
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Data Role Berhasil Diperbarui!');
    }

    // 5. Menghapus Data Role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Data Role Berhasil Dihapus!');
    }
}