<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pustaka untuk membuat slug otomatis

class CategoryController extends Controller
{
    // 1. Menampilkan Daftar Kategori
    public function index(Request $request)
    {
        $categories = Category::when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    // 2. Menampilkan Form Tambah Kategori
    public function create()
    {
        return view('admin.categories.create');
    }

    // 3. Menyimpan Kategori Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Mengubah nama menjadi URL-friendly (contoh: Berita Utama -> berita-utama)
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit Kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // 5. Memperbarui Kategori di Database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori Berhasil Diperbarui!');
    }

    // 6. Menghapus Kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori Berhasil Dihapus!');
    }
}