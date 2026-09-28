<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    // 1. Menampilkan Daftar Agenda
    public function index(Request $request)
    {
        $agendas = Agenda::when($request->q, function($query) use ($request) {
            $query->where('title', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.agendas.index', compact('agendas'));
    }

    // 2. Menampilkan Form Tambah Agenda
    public function create()
    {
        return view('admin.agendas.create');
    }

    // 3. Menyimpan Agenda Baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'time'        => 'required|string|max:100',
            'type'        => 'required|string'
        ]);

        Agenda::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'time'        => $request->time,
            'type'        => $request->type,
        ]);

        return redirect()->route('agendas.index')->with('success', 'Agenda Berhasil Disimpan!');
    }

    // 4. Menampilkan Form Edit Agenda
    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    // 5. Memperbarui Agenda
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'time'        => 'required|string|max:100',
            'type'        => 'required|string'
        ]);

        $agenda->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'time'        => $request->time,
            'type'        => $request->type,
        ]);

        return redirect()->route('agendas.index')->with('success', 'Agenda Berhasil Diperbarui!');
    }

    // 6. Menghapus Agenda
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'Agenda Berhasil Dihapus!');
    }
}