<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;

class HomepageSectionController extends Controller
{
    // 1. Menampilkan daftar section beranda
    public function index()
    {
        $sections = HomepageSection::orderBy('order', 'asc')->get();
        return view('admin.sections.index', compact('sections'));
    }

    // 2. Memperbarui urutan dan status section secara massal
    public function update(Request $request)
    {
        $orders = $request->input('order', []);
        $actives = $request->input('is_active', []);

        foreach ($orders as $id => $orderValue) {
            $section = HomepageSection::find($id);
            if ($section) {
                $section->order = $orderValue;
                // Cek apakah dicentang (aktif) atau tidak
                $section->is_active = isset($actives[$id]) ? true : false;
                $section->save();
            }
        }

        return redirect()->route('sections.index')->with('success', 'Urutan dan Status Tata Letak Beranda Berhasil Diperbarui!');
    }
}