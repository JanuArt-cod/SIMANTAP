<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    // Fungsi khusus untuk kompresi dan upload otomatis
    private function compressAndUpload($file)
    {
        $imageName = time() . '_' . uniqid() . '.' . $file->extension();
        $filePath = $file->getRealPath();
        
        list($width, $height) = getimagesize($filePath);
        
        // Batas maksimal lebar/tinggi gambar (1200px sudah sangat ideal untuk web)
        $maxWidth = 1200;
        $maxHeight = 1200;
        
        // Hitung dimensi proporsional baru
        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = $width / $height;
            if ($maxWidth / $maxHeight > $ratio) {
                $newWidth = $maxHeight * $ratio;
                $newHeight = $maxHeight;
            } else {
                $newWidth = $maxWidth;
                $newHeight = $maxWidth / $ratio;
            }
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }
        
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        $ext = strtolower($file->extension());
        
        // Buat resource gambar berdasarkan format aslinya
        if ($ext == 'png') {
            $src = imagecreatefrompng($filePath);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        } elseif ($ext == 'webp') {
            $src = imagecreatefromwebp($filePath);
        } else {
            $src = imagecreatefromjpeg($filePath);
        }
        
        // Proses resize gambar
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        $destinationPath = public_path('photos/' . $imageName);
        
        // Pastikan folder public/photos/ tersedia
        if (!file_exists(public_path('photos'))) {
            mkdir(public_path('photos'), 0777, true);
        }
        
        // Simpan dengan kompresi kualitas 75% (ukuran file jauh lebih ringan)
        if ($ext == 'png') {
            imagepng($dst, $destinationPath, 6);
        } elseif ($ext == 'webp') {
            imagewebp($dst, $destinationPath, 75);
        } else {
            imagejpeg($dst, $destinationPath, 75);
        }
        
        imagedestroy($dst);
        imagedestroy($src);
        
        return $imageName;
    }

    // 1. Menampilkan Daftar Galeri Foto
    public function index(Request $request)
    {
        $photos = Photo::when($request->q, function($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.photos.index', compact('photos'));
    }

    // 2. Menampilkan Form Tambah Foto
    public function create()
    {
        return view('admin.photos.create');
    }

    // 3. Menyimpan Foto Baru (Otomatis Dikompresi)
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,jpg,png,webp|max:10240', // Maksimal file asli 10MB sebelum dikompres
            'description' => 'nullable|string'
        ]);

        // Panggil fungsi kompresi otomatis
        $imageName = $this->compressAndUpload($request->file('image'));

        Photo::create([
            'title'       => $request->title,
            'image'       => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route('photos.index')->with('success', 'Foto Berhasil Diunggah & Dikompresi Otomatis!');
    }

    // 4. Menampilkan Form Edit Foto
    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    // 5. Memperbarui Foto
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'description' => 'nullable|string'
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
        ];

        // Jika admin mengunggah foto baru
        if ($request->hasFile('image')) {
            // Hapus file lama fisik jika ada
            if ($photo->image && file_exists(public_path('photos/' . $photo->image))) {
                unlink(public_path('photos/' . $photo->image));
            }

            // Kompres dan upload foto baru
            $data['image'] = $this->compressAndUpload($request->file('image'));
        }

        $photo->update($data);

        return redirect()->route('photos.index')->with('success', 'Galeri Foto Berhasil Diperbarui!');
    }

    // 6. Menghapus Foto
    public function destroy(Photo $photo)
    {
        if ($photo->image && file_exists(public_path('photos/' . $photo->image))) {
            unlink(public_path('photos/' . $photo->image));
        }

        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Foto Berhasil Dihapus!');
    }
}