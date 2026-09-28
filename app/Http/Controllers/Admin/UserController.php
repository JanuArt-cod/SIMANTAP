<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Menampilkan Daftar User
    public function index(Request $request)
    {
        $users = User::when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // 2. Menampilkan Form Tambah User
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // 3. Menyimpan User Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'roles'    => 'required'
        ]);

        // Buat user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Berikan role menggunakan Spatie
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('success', 'Data User Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit User
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // 5. Memperbarui Data User di Database
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'roles'    => 'required'
        ]);

        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Jika kolom password diisi, maka update passwordnya. Jika kosong, biarkan.
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Sinkronkan ulang role
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Data User Berhasil Diperbarui!');
    }

    // 6. Menghapus Data User
    public function destroy(User $user)
    {
        // Mencegah admin menghapus akunnya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Data User Berhasil Dihapus!');
    }
}