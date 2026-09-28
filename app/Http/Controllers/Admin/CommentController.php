<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 1. Menampilkan Daftar Komentar Berita
    public function index(Request $request)
    {
        $comments = Comment::with('post')->when($request->q, function($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('comment', 'like', '%' . $request->q . '%');
        })->latest()->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    // 2. Menampilkan Detail Komentar
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    // 3. Mengubah Status Publikasi Komentar (Publish / Unpublish)
    public function toggleApprove(Comment $comment)
    {
        // Membalik status (jika true jadi false, jika false jadi true)
        $comment->is_approved = !$comment->is_approved;
        $comment->save();

        $statusText = $comment->is_approved ? 'dipublikasikan' : 'disembunyikan';
        return redirect()->route('comments.index')->with('success', 'Komentar berhasil ' . $statusText . '!');
    }

    // 4. Menghapus Komentar
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Komentar Berhasil Dihapus!');
    }
}