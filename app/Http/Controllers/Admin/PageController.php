<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // Menampilkan Daftar Halaman Profil
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    // Menampilkan Form Tambah Halaman
    public function create()
    {
        return view('admin.pages.create');
    }

    // Menyimpan Halaman Baru
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('pages.index')->with('success', 'Halaman Profil Berhasil Disimpan!');
    }

    // Menampilkan Form Edit Halaman
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    // Memperbarui Halaman Profil
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('pages.index')->with('success', 'Halaman Profil Berhasil Diperbarui!');
    }

    // Menghapus Halaman Profil
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Halaman Profil Berhasil Dihapus!');
    }
}