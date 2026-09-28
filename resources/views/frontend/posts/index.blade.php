@extends('layouts.public')

@section('title', 'Berita & Artikel')

@section('content')
<div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-16">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">Berita & Informasi Sekolah</h1>
        <p class="text-slate-600 dark:text-slate-400 mt-3">Ikuti perkembangan terbaru, pengumuman penting, dan kegiatan seputar sekolah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="backdrop-blur-md bg-white/80 dark:bg-slate-900/80 rounded-3xl overflow-hidden border border-slate-200/60 dark:border-slate-800/60 shadow-xl flex flex-col justify-between">
                <div>
                    <img src="{{ asset('posts/' . $post->image) }}" class="w-full h-52 object-cover" alt="Post">
                    <div class="p-6">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300">{{ $post->category->name }}</span>
                        <h3 class="font-bold text-slate-900 dark:text-white text-xl mt-3 mb-2 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3">{{ strip_tags($post->content) }}</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('public.posts.show', $post->slug) }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">Baca Selengkapnya <i class="fas fa-chevron-right ml-1 text-xs"></i></a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-slate-500">Belum ada berita tersedia.</div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
@endsection