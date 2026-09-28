@extends('layouts.public')

@section('title', 'Beranda Resmi')

@section('content')

    <!-- LOOPING SECTION BERDASARKAN URUTAN ADMIN -->
    @foreach($sections as $section)

        <!-- 1. SLIDER BANNER / HERO SECTION -->
        @if($section->key == 'slider')
            @if($sliders->count() > 0)
                <div class="relative w-full h-[540px] overflow-hidden bg-slate-900" x-data="{ activeSlide: 0, slides: {{ $sliders->count() }} }" x-init="setInterval(() => activeSlide = (activeSlide + 1) % slides, 6000)">
                    @foreach($sliders as $index => $slider)
                        <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0">
                            <img src="{{ asset('sliders/' . $slider->image) }}" class="w-full h-full object-cover opacity-60" alt="Slider">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-900/60 to-slate-950/80 flex items-center justify-center text-center px-4">
                                <div class="max-w-3xl space-y-5 animate-fade-in">
                                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-lg transform hover:scale-105 transition">Pendaftaran Siswa Baru Telah Dibuka</span>
                                    @if($slider->title)
                                        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight drop-shadow-lg leading-tight">{{ $slider->title }}</h1>
                                    @endif
                                    @if($slider->subtitle)
                                        <p class="text-lg text-emerald-100 font-medium drop-shadow">{{ $slider->subtitle }}</p>
                                    @endif
                                    <div class="pt-2">
                                        <a href="{{ route('public.posts') }}" class="px-6 py-3 rounded-full bg-amber-400 hover:bg-amber-500 text-slate-900 font-bold text-sm shadow-xl transform hover:-translate-y-1 transition mr-2 inline-block">Jelajahi Berita</a>
                                        <a href="{{ route('public.contact') }}" class="px-6 py-3 rounded-full bg-white/20 hover:bg-white/30 text-white font-bold text-sm backdrop-blur-md border border-white/30 transform hover:-translate-y-1 transition inline-block">Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="relative bg-gradient-to-r from-emerald-800 to-slate-900 py-24 text-white text-center px-4">
                    <div class="max-w-3xl mx-auto space-y-4">
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-amber-400 text-slate-900 shadow-lg">Pendaftaran Siswa Baru Telah Dibuka</span>
                        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Mewujudkan Generasi Unggul & Berkompetensi Global</h1>
                        <p class="text-emerald-100 text-base">Sekolah kejuruan berbasis teknologi modern yang siap mengantarkan Anda menjadi tenaga profesional handal.</p>
                    </div>
                </div>
            @endif
        @endif

        <!-- STATISTIK SEKOLAH (iOS Glass Card) -->
        @if($section->key == 'slider' || $loop->first)
            <section class="py-10 -mt-12 relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 border-l-4 border-emerald-500 border-t border-r border-b border-white/50 dark:border-slate-800/80 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-1 group-hover:scale-105 transition transform origin-left">1,250+</h3>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siswa Aktif</p>
                    </div>
                    <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 border-l-4 border-emerald-500 border-t border-r border-b border-white/50 dark:border-slate-800/80 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-1 group-hover:scale-105 transition transform origin-left">75+</h3>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Guru & Staff Ahli</p>
                    </div>
                    <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 border-l-4 border-emerald-500 border-t border-r border-b border-white/50 dark:border-slate-800/80 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-1 group-hover:scale-105 transition transform origin-left">4</h3>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jurusan Unggulan</p>
                    </div>
                    <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 border-l-4 border-emerald-500 border-t border-r border-b border-white/50 dark:border-slate-800/80 p-6 rounded-2xl shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                        <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-1 group-hover:scale-105 transition transform origin-left">98%</h3>
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Lulusan Kerja</p>
                    </div>
                </div>
            </section>
        @endif

        <!-- 2. SAMBUTAN KEPALA SEKOLAH -->
        @if($section->key == 'welcome' && ($setting->welcome_title || $setting->welcome_text))
            <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="backdrop-blur-3xl bg-white/75 dark:bg-slate-900/60 rounded-3xl border border-white/60 dark:border-slate-800/80 shadow-2xl p-8 md:p-12 transition-all duration-500 hover:shadow-emerald-500/10">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-10 items-center">
                        <div class="md:col-span-4 text-center">
                            <div class="relative inline-block group">
                                @if($setting->welcome_image)
                                    <img src="{{ asset('logo/' . $setting->welcome_image) }}" class="rounded-2xl shadow-2xl w-64 h-80 object-cover mx-auto border-4 border-emerald-500/20 transform group-hover:scale-[1.02] transition duration-500" alt="Kepala Sekolah">
                                @else
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=600&auto=format&fit=crop" class="rounded-2xl shadow-2xl w-64 h-80 object-cover mx-auto border-4 border-emerald-500/20 transform group-hover:scale-[1.02] transition duration-500" alt="Default Principal">
                                @endif
                            </div>
                            <div class="mt-4">
                                <h4 class="font-bold text-slate-900 dark:text-white text-base">{{ $setting->welcome_name ?? 'Dr. H. Ahmad Fauzi, M.Pd.' }}</h4>
                                <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mt-0.5">{{ $setting->welcome_position ?? 'Kepala Sekolah' }}</p>
                            </div>
                        </div>

                        <div class="md:col-span-8 space-y-4">
                            <span class="px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 shadow-sm">Sambutan Pimpinan</span>
                            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $setting->welcome_title ?? 'Sambutan Kepala Sekolah' }}</h2>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm md:text-base whitespace-pre-line">{{ $setting->welcome_text }}</p>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- 3. AGENDA & KEGIATAN -->
        @if($section->key == 'agendas' && $agendas->count() > 0)
            <section class="py-16 bg-slate-200/40 dark:bg-slate-900/40 backdrop-blur-md border-y border-slate-200/50 dark:border-slate-800/60">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-10">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Jadwal & Kegiatan</span>
                            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-1">Agenda Terdekat</h2>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($agendas as $agenda)
                            <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 p-6 rounded-2xl border border-white/60 dark:border-slate-800/80 shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group">
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 mb-3 inline-block shadow-sm">{{ $agenda->type }}</span>
                                <h3 class="font-bold text-slate-900 dark:text-white text-base mb-2 line-clamp-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $agenda->title }}</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2"><i class="fas fa-calendar-alt mr-1.5 text-emerald-600"></i> {{ date('d M Y', strtotime($agenda->start_date)) }}</p>
                                <p class="text-xs text-slate-600 dark:text-slate-300"><i class="fas fa-map-marker-alt mr-1.5 text-emerald-600"></i> {{ $agenda->location }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- 4. BERITA TERBARU -->
        @if($section->key == 'posts' && $posts->count() > 0)
            <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Informasi Publik</span>
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-1">Berita & Informasi Terbaru</h2>
                    </div>
                    <a href="{{ route('public.posts') }}" class="px-4 py-2 rounded-xl border border-emerald-600 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-600 hover:text-white text-xs font-bold transition transform hover:scale-105 shadow-sm">Lihat Semua &rarr;</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 rounded-3xl overflow-hidden border border-white/60 dark:border-slate-800/80 shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="overflow-hidden">
                                    <img src="{{ asset('posts/' . $post->image) }}" class="w-full h-52 object-cover transform group-hover:scale-110 transition duration-700" alt="Post">
                                </div>
                                <div class="p-6">
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 mb-3 inline-block shadow-sm">{{ $post->category->name }}</span>
                                    <h3 class="font-bold text-slate-900 dark:text-white text-lg mb-3 line-clamp-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $post->title }}</h3>
                                    <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3 leading-relaxed">{{ strip_tags($post->content) }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="{{ route('public.posts.show', $post->slug) }}" class="block text-center py-2.5 rounded-xl border border-emerald-600 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-600 hover:text-white text-xs font-bold transition shadow-sm">Baca Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- PENGUMUMAN & SURAT RESMI -->
        @if($section->key == 'announcements' && $announcements->count() > 0)
            <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Informasi Resmi</span>
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-1">Pengumuman & Surat Terbaru</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($announcements as $announcement)
                        <div class="backdrop-blur-2xl bg-white/75 dark:bg-slate-900/60 rounded-3xl overflow-hidden border border-white/60 dark:border-slate-800/80 shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group p-6">
                            <div>
                                @if($announcement->image)
                                    <div class="overflow-hidden rounded-2xl mb-4">
                                        <img src="{{ asset('announcements/images/' . $announcement->image) }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-700" alt="Pengumuman">
                                    </div>
                                @endif
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 shadow-sm">Pengumuman</span>
                                    <span class="text-xs text-slate-400">{{ $announcement->created_at->format('d M Y') }}</span>
                                </div>
                                
                                <!-- -->
                                <!-- TEMPATKAN / GANTI KODE JUDUL DI SINI: -->
                                <!-- -->
                                <h3 class="font-bold text-slate-900 dark:text-white text-lg mb-3 line-clamp-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">
                                    <a href="{{ route('public.announcements.show', $announcement->slug) }}">
                                        {{ $announcement->title }}
                                    </a>
                                </h3>

                                <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3 leading-relaxed mb-6">{{ strip_tags($announcement->content) }}</p>
                            </div>
                            
                            <!-- Tombol Unduh Surat Resmi -->
                            <div>
                                @if($announcement->file)
                                    <a href="{{ asset('announcements/files/' . $announcement->file) }}" target="_blank" class="w-full block text-center py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wider transition shadow-lg shadow-emerald-600/30">
                                        <i class="fas fa-download mr-1.5"></i> Unduh Surat Resmi
                                    </a>
                                @else
                                    <span class="w-full block text-center py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Tidak Ada Lampiran Surat
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- 5. GALERI FOTO & VIDEO -->
        @if($section->key == 'galleries' && ($photos->count() > 0 || $videos->count() > 0))
            <section class="py-20 bg-slate-200/40 dark:bg-slate-900/40 backdrop-blur-md border-t border-slate-200/50 dark:border-slate-800/60">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-2xl mx-auto mb-16">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Dokumentasi</span>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mt-1">Galeri Kegiatan Sekolah</h2>
                    </div>

                    @if($photos->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($photos as $photo)
                                <div class="group relative overflow-hidden rounded-2xl shadow-xl aspect-video bg-slate-200 dark:bg-slate-800 border border-white/40 dark:border-slate-800">
                                    <img src="{{ asset('photos/' . $photo->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Foto">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                                        <p class="text-white font-medium text-sm transform translate-y-2 group-hover:translate-y-0 transition duration-300">{{ $photo->title }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

    @endforeach

@endsection