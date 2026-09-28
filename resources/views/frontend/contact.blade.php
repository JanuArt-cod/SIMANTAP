@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
<div class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-16">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">Hubungi Kami</h1>
        <p class="text-slate-600 dark:text-slate-400 mt-3">Punya pertanyaan, saran, atau masukan? Kirimkan pesan melalui formulir di bawah ini.</p>
    </div>

    <div class="backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 rounded-3xl border border-slate-200/60 dark:border-slate-800/60 shadow-2xl p-8 md:p-12">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('public.messages.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">SUBJEK / PERIHAL</label>
                <input type="text" name="subject" class="w-full px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">ISI PESAN</label>
                <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" required></textarea>
            </div>
            <button type="submit" class="w-full py-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-lg shadow-emerald-600/30 transition">Kirim Pesan</button>
        </form>
    </div>
</div>
@endsection