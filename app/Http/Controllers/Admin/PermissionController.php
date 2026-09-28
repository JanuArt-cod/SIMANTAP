<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission; // Memanggil model Permission bawaan Spatie
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan data permission dengan fitur pagination (10 data per halaman)
        // Jika ada pencarian, data akan difilter berdasarkan nama
        $permissions = Permission::when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.permissions.index', compact('permissions'));
    }
}