<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Agenda;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Slider;
use App\Models\HomepageSection;
use App\Models\Message;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman Beranda Utama (Render Berdasarkan Urutan Admin)
    public function index()
    {
        $sections      = HomepageSection::where('is_active', true)->orderBy('order', 'asc')->get();
        $sliders       = Slider::where('is_active', true)->get();
        $setting       = Setting::first();
        $posts         = Post::latest()->take($setting->posts_limit ?? 3)->get();
        $agendas       = Agenda::latest()->take(4)->get();
        $announcements = \App\Models\Announcement::latest()->take(3)->get(); // <-- Tambahkan ini
        $photos        = Photo::latest()->take(6)->get();
        $videos        = Video::latest()->take(4)->get();

        return view('frontend.home', compact('sections', 'sliders', 'setting', 'posts', 'agendas', 'announcements', 'photos', 'videos'));
    }

    // Halaman Daftar Semua Berita
    public function posts()
    {
        $posts = Post::latest()->paginate(6);
        return view('frontend.posts.index', compact('posts'));
    }

    // Halaman Detail Berita & Komentar
    public function showPost(Post $post)
    {
        $comments = $post->comments()->where('is_approved', true)->latest()->get();
        return view('frontend.posts.show', compact('post', 'comments'));
    }

    // Menyimpan Komentar Publik
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        Comment::create([
            'post_id'     => $post->id,
            'name'        => $request->name,
            'email'       => $request->email,
            'comment'     => $request->comment,
            'is_approved' => false, // Pending untuk dimoderasi admin
        ]);

        return back()->with('success', 'Komentar berhasil dikirim dan sedang menunggu moderasi admin.');
    }

    // Halaman Kontak & Kirim Pesan
    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($request->all());

        return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.');
    }
    // Tambahkan fungsi ini di dalam PublicController.php
    public function showAnnouncement($slug)
    {
        $announcement = \App\Models\Announcement::where('slug', $slug)->firstOrFail();
        $setting = \App\Models\Setting::first();
        
        return view('frontend.announcements.show', compact('announcement', 'setting'));
    }
    // Menampilkan Halaman Profil Statis di Publik
    public function showPage($slug)
    {
        $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
        $setting = \App\Models\Setting::first();
        
        return view('frontend.pages.show', compact('page', 'setting'));
    }
}