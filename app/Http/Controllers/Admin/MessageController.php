<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // 1. Menampilkan Daftar Pesan Masuk
    public function index(Request $request)
    {
        $messages = Message::when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('subject', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    // 2. Menampilkan Detail Pesan Masuk
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    // 3. Menghapus Pesan
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Pesan Berhasil Dihapus!');
    }
}