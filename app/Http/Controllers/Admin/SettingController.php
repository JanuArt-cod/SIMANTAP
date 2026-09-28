<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Fungsi kompresi otomatis khusus logo agar ukurannya kecil & ringan
    private function compressAndUploadLogo($file)
    {
        $imageName = 'logo_' . time() . '.' . $file->extension();
        $filePath = $file->getRealPath();
        
        list($width, $height) = getimagesize($filePath);
        $maxWidth = 500; // Logo tidak perlu terlalu besar, maks lebar 500px
        $maxHeight = 500;
        
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
        
        if ($ext == 'png') {
            $src = imagecreatefrompng($filePath);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        } elseif ($ext == 'webp') {
            $src = imagecreatefromwebp($filePath);
        } else {
            $src = imagecreatefromjpeg($filePath);
        }
        
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        $destinationPath = public_path('logo/' . $imageName);
        
        if (!file_exists(public_path('logo'))) {
            mkdir(public_path('logo'), 0777, true);
        }
        
        if ($ext == 'png') {
            imagepng($dst, $destinationPath, 6);
        } elseif ($ext == 'webp') {
            imagewebp($dst, $destinationPath, 80);
        } else {
            imagejpeg($dst, $destinationPath, 80);
        }
        
        imagedestroy($dst);
        imagedestroy($src);
        
        return $imageName;
    }

    // 1. Menampilkan Form Edit Pengaturan (Karena hanya ada 1 data, langsung ambil baris pertama)
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    // 2. Menyimpan / Memperbarui Pengaturan
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'site_name'        => 'required|string|max:255',
            'school_name'      => 'required|string|max:255',
            'logo'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'welcome_image'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'email'            => 'nullable|email',
            'phone'            => 'nullable|string',
            'facebook'         => 'nullable|url|max:255',
            'instagram'        => 'nullable|url|max:255',
            'youtube'          => 'nullable|url|max:255',
            'tiktok'           => 'nullable|url|max:255',
            'address'          => 'nullable|string',
            'welcome_title'    => 'nullable|string|max:255',
            'welcome_text'     => 'nullable|string',
            'welcome_name'     => 'nullable|string|max:255', // <-- Tambahkan validasi
            'welcome_position' => 'nullable|string|max:255', // <-- Tambahkan validasi
            'posts_limit'      => 'required|integer|min:1'
        ]);

        $data = [
            'site_name'        => $request->site_name,
            'school_name'      => $request->school_name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'address'          => $request->address,
            'facebook'         => $request->facebook,
            'instagram'        => $request->instagram,
            'youtube'          => $request->youtube,
            'tiktok'           => $request->tiktok,
            'welcome_title'    => $request->welcome_title,
            'welcome_text'     => $request->welcome_text,
            'welcome_name'     => $request->welcome_name,     // <-- Masukkan ke data
            'welcome_position' => $request->welcome_position, // <-- Masukkan ke data
            'posts_limit'      => $request->posts_limit,
        ];

        // Upload Logo Utama
        if ($request->hasFile('logo')) {
            if ($setting->logo && file_exists(public_path('logo/' . $setting->logo))) {
                unlink(public_path('logo/' . $setting->logo));
            }
            $data['logo'] = $this->compressAndUploadLogo($request->file('logo'));
        }

        // Upload Foto Sambutan
        if ($request->hasFile('welcome_image')) {
            if ($setting->welcome_image && file_exists(public_path('logo/' . $setting->welcome_image))) {
                unlink(public_path('logo/' . $setting->welcome_image));
            }
            // Menggunakan fungsi kompresi yang sama agar efisien
            $data['welcome_image'] = $this->compressAndUploadLogo($request->file('welcome_image'));
        }

        $setting->update($data);

        return redirect()->route('settings.index')->with('success', 'Pengaturan Website & Sambutan Berhasil Diperbarui!');
    }
}