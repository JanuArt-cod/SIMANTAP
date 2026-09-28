@extends('layouts.public')

@section('title', $announcement->title)

@section('content')
<div class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="backdrop-blur-3xl bg-white/75 dark:bg-slate-900/65 rounded-3xl border border-white/60 dark:border-slate-800/80 shadow-2xl p-8 md:p-12 transition-all">
        
        <!-- Tombol Kembali & Kategori -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-4 inline-block">&larr; Kembali ke Beranda</a>
            <div class="flex items-center space-x-3 text-xs text-slate-500 dark:text-slate-400 mb-3">
                <span class="px-2.5 py-1 rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 font-bold shadow-sm">Pengumuman Resmi</span>
                <span><i class="fas fa-calendar-alt mr-1 text-emerald-600"></i> {{ $announcement->created_at->format('d M Y') }}</span>
            </div>
            <h1 class="text-2xl md:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">{{ $announcement->title }}</h1>
        </div>

        <!-- Gambar Ilustrasi -->
        @if($announcement->image)
            <div class="mb-8 rounded-2xl overflow-hidden shadow-xl border border-slate-200/50 dark:border-slate-800">
                <img src="{{ asset('announcements/images/' . $announcement->image) }}" class="w-full max-h-[450px] object-cover" alt="Gambar Pengumuman">
            </div>
        @endif

        <!-- Isi Konten Pengumuman -->
        <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-base space-y-4 mb-10 whitespace-pre-line">
            {{ $announcement->content }}
        </div>

        <!-- Kotak Unduh Surat Resmi (Jika ada file) -->
        @if($announcement->file)
            <div class="p-6 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/40 border border-emerald-500/30 flex flex-col sm:flex-row items-center justify-between gap-4 backdrop-blur-md">
                <div class="flex items-center space-x-4">
                    <div class="p-3.5 rounded-xl bg-emerald-600 text-white shadow-md">
                        <i class="fas fa-file-pdf text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-0.5">Lampiran Surat Resmi Sekolah</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Silakan unduh dokumen surat resmi untuk informasi lebih lengkap.</p>
                    </div>
                </div>
                <a href="{{ asset('announcements/files/' . $announcement->file) }}" target="_blank" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wider transition shadow-lg shadow-emerald-600/30 whitespace-nowrap">
                    <i class="fas fa-download mr-1.5"></i> Unduh Surat
                </a>
            </div>
        @endif

    </div>
</div>
@endsection