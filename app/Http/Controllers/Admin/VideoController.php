<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // 1. Menampilkan Daftar Galeri Video
    public function index(Request $request)
    {
        $videos = Video::when($request->q, function($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.videos.index', compact('videos'));
    }

    // 2. Menampilkan Form Tambah Video
    public function create()
    {
        return view('admin.videos.create');
    }

    // 3. Menyimpan Video Baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|string', // Link YouTube, TikTok, atau IG Reels
            'description' => 'nullable|string'
        ]);

        Video::create([
            'title'       => $request->title,
            'url'         => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'Link Video Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit Video
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    // 5. Memperbarui Video
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|string',
            'description' => 'nullable|string'
        ]);

        $video->update([
            'title'       => $request->title,
            'url'         => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.index')->with('success', 'Galeri Video Berhasil Diperbarui!');
    }

    // 6. Menghapus Video
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video Berhasil Dihapus!');
    }
}