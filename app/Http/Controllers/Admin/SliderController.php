<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    // Fungsi kompresi gambar slider agar ukuran layarnya pas & ringan
    private function compressAndUploadSlider($file)
    {
        $imageName = 'slider_' . time() . '_' . uniqid() . '.' . $file->extension();
        $filePath = $file->getRealPath();
        
        list($width, $height) = getimagesize($filePath);
        $maxWidth = 1920; // Lebar standar banner web
        $maxHeight = 1080;
        
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
        
        $destinationPath = public_path('sliders/' . $imageName);
        
        if (!file_exists(public_path('sliders'))) {
            mkdir(public_path('sliders'), 0777, true);
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

    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image'    => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
        ]);

        $imageName = $this->compressAndUploadSlider($request->file('image'));

        Slider::create([
            'title'    => $request->title,
            'subtitle' => $request->subtitle,
            'image'    => $imageName,
            'is_active'=> $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider Banner Berhasil Ditambahkan!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'    => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        ]);

        $data = [
            'title'    => $request->title,
            'subtitle' => $request->subtitle,
            'is_active'=> $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('image')) {
            if ($slider->image && file_exists(public_path('sliders/' . $slider->image))) {
                unlink(public_path('sliders/' . $slider->image));
            }
            $data['image'] = $this->compressAndUploadSlider($request->file('image'));
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider Banner Berhasil Diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && file_exists(public_path('sliders/' . $slider->image))) {
            unlink(public_path('sliders/' . $slider->image));
        }

        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider Banner Berhasil Dihapus!');
    }
}