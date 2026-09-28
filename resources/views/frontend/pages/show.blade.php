@extends('layouts.public')

@section('title', $page->title)

@section('content')
<div class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="backdrop-blur-3xl bg-white/75 dark:bg-slate-900/65 rounded-3xl border border-white/60 dark:border-slate-800/80 shadow-2xl p-8 md:p-12 transition-all">
        
        <!-- Tombol Kembali & Judul -->
        <div class="mb-8 border-b border-slate-200/60 dark:border-slate-800 pb-6">
            <a href="{{ route('home') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">&larr; Kembali ke Beranda</a>
            <span class="block px-2.5 py-1 w-max text-xs font-bold rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 shadow-sm mb-3">Profil Resmi Sekolah</span>
            <h1 class="text-2xl md:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">{{ $page->title }}</h1>
        </div>

        <!-- Isi Konten Profil -->
        <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-base space-y-4 whitespace-pre-line">
            {!! $page->content !!}
        </div>

    </div>
</div>
@endsection