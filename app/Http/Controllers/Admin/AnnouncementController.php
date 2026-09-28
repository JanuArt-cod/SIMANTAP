<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    // 1. Menampilkan Daftar Pengumuman
    public function index(Request $request)
    {
        $announcements = Announcement::when($request->q, function($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.announcements.index', compact('announcements'));
    }

    // 2. Menampilkan Form Tambah Pengumuman
    public function create()
    {
        return view('admin.announcements.create');
    }

    // 3. Menyimpan Pengumuman Baru
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120', // Maks 5MB
            'file'    => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:10240',   // Dokumen surat resmi maks 10MB
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = 'announcement_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('announcements/images'), $imageName);
        }

        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = 'surat_' . time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('announcements/files'), $fileName);
        }

        Announcement::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image'   => $imageName,
            'file'    => $fileName,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit Pengumuman
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    // 5. Memperbarui Pengumuman
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'file'    => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $data = [
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->content,
        ];

        // Update Gambar jika ada upload baru
        if ($request->hasFile('image')) {
            if ($announcement->image && file_exists(public_path('announcements/images/' . $announcement->image))) {
                unlink(public_path('announcements/images/' . $announcement->image));
            }
            $imageName = 'announcement_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('announcements/images'), $imageName);
            $data['image'] = $imageName;
        }

        // Update File Surat jika ada upload baru
        if ($request->hasFile('file')) {
            if ($announcement->file && file_exists(public_path('announcements/files/' . $announcement->file))) {
                unlink(public_path('announcements/files/' . $announcement->file));
            }
            $fileName = 'surat_' . time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('announcements/files'), $fileName);
            $data['file'] = $fileName;
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman Berhasil Diperbarui!');
    }

    // 6. Menghapus Pengumuman
    public function destroy(Announcement $announcement)
    {
        if ($announcement->image && file_exists(public_path('announcements/images/' . $announcement->image))) {
            unlink(public_path('announcements/images/' . $announcement->image));
        }

        if ($announcement->file && file_exists(public_path('announcements/files/' . $announcement->file))) {
            unlink(public_path('announcements/files/' . $announcement->file));
        }

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Pengumuman Berhasil Dihapus!');
    }
}