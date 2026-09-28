@extends('layouts.public')

@section('title', $post->title)

@section('content')
<article class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Berita -->
    <div class="mb-8 text-center">
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 inline-block mb-4">{{ $post->category->name }}</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight mb-4">{{ $post->title }}</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400"><i class="fas fa-user mr-1 text-emerald-600"></i> {{ $post->user->name }} &bull; <i class="fas fa-calendar mr-1 ml-3 text-emerald-600"></i> {{ $post->created_at->format('d F Y') }}</p>
    </div>

    <!-- Thumbnail -->
    <div class="mb-10 rounded-3xl overflow-hidden shadow-2xl">
        <img src="{{ asset('posts/' . $post->image) }}" class="w-full max-h-[450px] object-cover" alt="Thumbnail">
    </div>

    <!-- Konten Berita -->
    <div class="backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 rounded-3xl border border-slate-200/60 dark:border-slate-800/60 shadow-xl p-8 md:p-12 prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed space-y-6">
        {!! nl2br(e($post->content)) !!}
    </div>

    <!-- SECTION KOMENTAR -->
    <div class="mt-16 backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 rounded-3xl border border-slate-200/60 dark:border-slate-800/60 shadow-xl p-8 md:p-12">
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-8"><i class="fas fa-comments mr-2 text-emerald-600"></i> Komentar ({{ $comments->count() }})</h3>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Komentar yang Telah Disetujui Admin -->
        <div class="space-y-6 mb-12">
            @forelse($comments as $comment)
                <div class="p-5 rounded-2xl bg-slate-100/70 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $comment->name }}</h4>
                        <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">{{ $comment->comment }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-500 italic">Belum ada komentar yang dipublikasikan pada berita ini.</p>
            @endforelse
        </div>

        <!-- Form Kirim Komentar -->
        <form action="{{ route('public.comments.store', $post->id) }}" method="POST" class="space-y-4">
            @csrf
            <h4 class="font-bold text-slate-900 dark:text-white text-lg mb-4">Tinggalkan Komentar</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">NAMA LENGKAP</label>
                    <input type="text" name="name" class="w-full px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">ALAMAT EMAIL</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">PESAN / KOMENTAR</label>
                <textarea name="comment" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" required></textarea>
            </div>
            <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-lg shadow-emerald-600/30 transition">Kirim Komentar</button>
        </form>
    </div>
</article>
@endsection