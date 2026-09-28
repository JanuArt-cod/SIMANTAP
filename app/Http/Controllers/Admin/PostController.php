<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // 1. Menampilkan Daftar Berita
    public function index(Request $request)
    {
        // Mengambil data berita beserta relasi category dan user (penulis)
        $posts = Post::with('category', 'user')->when($request->q, function($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    // 2. Menampilkan Form Tambah Berita
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    // 3. Menyimpan Berita Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required',
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048', // Maksimal 2MB
            'content'     => 'required'
        ]);

        // Proses Upload Gambar
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('posts'), $imageName); // Disimpan di folder public/posts/

        // Simpan ke database
        Post::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'category_id' => $request->category_id,
            'user_id'     => auth()->id(), // Mengambil ID admin yang sedang login
            'image'       => $imageName,
            'content'     => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Berita Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit Berita
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // 5. Memperbarui Berita di Database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'content'     => 'required'
        ]);

        $data = [
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'category_id' => $request->category_id,
            'content'     => $request->content,
        ];

        // Jika admin mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && file_exists(public_path('posts/' . $post->image))) {
                unlink(public_path('posts/' . $post->image));
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('posts'), $imageName);
            
            $data['image'] = $imageName;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Berita Berhasil Diperbarui!');
    }

    // 6. Menghapus Berita
    public function destroy(Post $post)
    {
        // Hapus file gambar fisik dari folder public/posts/
        if ($post->image && file_exists(public_path('posts/' . $post->image))) {
            unlink(public_path('posts/' . $post->image));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Berita Berhasil Dihapus!');
    }
}