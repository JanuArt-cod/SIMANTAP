<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', mobileMenu: false }" :class="{ 'dark': darkMode }" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &mdash; {{ $setting->school_name ?? 'Portal Sekolah' }}</title>
    
    @if($setting && $setting->logo)
        <link rel="icon" href="{{ asset('logo/' . $setting->logo) }}" type="image/png">
    @endif

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-emerald-50/80 via-slate-100 to-teal-50/60 dark:from-slate-950 dark:via-slate-900 dark:to-emerald-950/50 text-slate-800 dark:text-slate-100 font-sans antialiased transition-colors duration-500 min-h-screen flex flex-col justify-between selection:bg-emerald-500 selection:text-white">

    <!-- TOP BAR INFO -->
    <div class="bg-emerald-600 dark:bg-emerald-950 text-white text-xs py-2.5 hidden md:block transition-colors border-b border-emerald-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex space-x-6">
                <span><i class="fas fa-map-marker-alt mr-1.5 text-emerald-300 animate-pulse"></i> {{ $setting->address ?? 'Kota Bogor, Jawa Barat' }}</span>
                <span><i class="fas fa-phone mr-1.5 text-emerald-300"></i> {{ $setting->phone ?? '(0251) 1234567' }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <span><i class="fas fa-envelope mr-1.5 text-emerald-300"></i> {{ $setting->email ?? 'info@sekolah.com' }}</span>
                <div class="space-x-2 pl-3 border-l border-emerald-500/40">
                    @if($setting && $setting->facebook)
                        <a href="{{ $setting->facebook }}" target="_blank" class="hover:text-emerald-200 transition transform hover:scale-125 inline-block"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($setting && $setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank" class="hover:text-emerald-200 transition transform hover:scale-125 inline-block"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($setting && $setting->youtube)
                        <a href="{{ $setting->youtube }}" target="_blank" class="hover:text-emerald-200 transition transform hover:scale-125 inline-block"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($setting && $setting->tiktok)
                        <a href="{{ $setting->tiktok }}" target="_blank" class="hover:text-emerald-200 transition transform hover:scale-125 inline-block"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR UTAMA (iOS Glassmorphism) -->
    <header class="sticky top-0 z-50 backdrop-blur-2xl bg-white/70 dark:bg-slate-900/70 border-b border-slate-200/50 dark:border-slate-800/60 shadow-lg shadow-slate-900/5 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                @if($setting && $setting->logo)
                    <img src="{{ asset('logo/' . $setting->logo) }}" class="h-10 w-auto rounded-xl shadow-md transform group-hover:rotate-6 transition duration-300" alt="Logo">
                @endif
                <div>
                    <span class="font-bold text-lg tracking-tight block text-slate-900 dark:text-white leading-tight uppercase">{{ $setting->school_name ?? 'SMK Bina Insan Mandiri' }}</span>
                    <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold tracking-wide">Portal Resmi Sekolah</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center space-x-8 font-semibold text-sm">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition transform hover:-translate-y-0.5">Beranda</a>
                <!-- DROPDOWN MENU PROFIL SEKOLAH (Dinamis dari Database) -->
                <div class="relative group">
                    <button class="flex items-center text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition py-2 focus:outline-none">
                        Profil <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="absolute left-0 mt-0 w-48 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl rounded-2xl shadow-xl border border-white/60 dark:border-slate-800 py-2 hidden group-hover:block transition-all z-50">
                        @php
                            $navPages = \App\Models\Page::all();
                        @endphp
                        
                        @forelse($navPages as $navPage)
                            <a href="{{ route('public.pages.show', $navPage->slug) }}" class="block px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/50 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition">
                                {{ $navPage->title }}
                            </a>
                        @empty
                            <span class="block px-4 py-2 text-xs text-slate-400">Belum ada profil</span>
                        @endforelse
                    </div>
                </div>
                <!-- END DROPDOWN PROFIL -->
                <a href="{{ route('public.posts') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition transform hover:-translate-y-0.5">Berita</a>
                <a href="{{ route('public.contact') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition transform hover:-translate-y-0.5">Kontak</a>
            </nav>

            <div class="flex items-center space-x-4">
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-2.5 rounded-full bg-slate-200/70 dark:bg-slate-800/70 text-slate-700 dark:text-slate-300 hover:scale-110 active:scale-95 transition shadow-md">
                    <i class="fas transition-transform duration-500" :class="darkMode ? 'fa-sun text-yellow-400 rotate-180' : 'fa-moon text-slate-700'"></i>
                </button>

                <a href="{{ route('public.contact') }}" class="hidden sm:inline-block px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-emerald-600/30 transform hover:-translate-y-0.5 transition">PPDB 2026</a>

                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2.5 rounded-xl bg-slate-200/70 dark:bg-slate-800/70 text-slate-700 dark:text-slate-300">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <div x-show="mobileMenu" x-transition.origin.top.duration.300 class="md:hidden backdrop-blur-2xl bg-white/95 dark:bg-slate-900/95 border-b border-slate-200 dark:border-slate-800 px-6 py-4 space-y-3 shadow-xl">
            <a href="{{ route('home') }}" class="block font-medium py-2 hover:text-emerald-600">Beranda</a>
            <a href="{{ route('public.posts') }}" class="block font-medium py-2 hover:text-emerald-600">Berita</a>
            <a href="{{ route('public.contact') }}" class="block font-medium py-2 hover:text-emerald-600">Kontak</a>
            <a href="{{ route('public.contact') }}" class="block text-center py-2.5 rounded-full bg-emerald-600 text-white font-bold text-xs uppercase shadow-md">PPDB 2026</a>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-slate-900 dark:bg-slate-950 text-white pt-16 pb-8 border-t border-slate-800/80 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        @if($setting && $setting->logo)
                            <img src="{{ asset('logo/' . $setting->logo) }}" class="h-9 w-auto" alt="Logo">
                        @endif
                        <span class="font-bold text-lg text-white uppercase">{{ $setting->school_name ?? 'SMK Bina Insan Mandiri' }}</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">Membangun generasi unggul yang berkarakter, cerdas, terampil, dan siap menghadapi tantangan era digital global.</p>
                </div>
                <div>
                    <h4 class="font-bold text-white text-sm mb-4 uppercase tracking-wider">Menu Cepat</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="{{ route('public.posts') }}" class="hover:text-emerald-400 transition">Berita & Informasi</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-emerald-400 transition">Kontak & Buku Tamu</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white text-sm mb-4 uppercase tracking-wider">Kontak & Lokasi</h4>
                    <p class="text-slate-400 text-sm mb-2"><i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i> {{ $setting->address ?? 'Kota Bogor' }}</p>
                    <p class="text-slate-400 text-sm"><i class="fas fa-envelope mr-2 text-emerald-500"></i> {{ $setting->email ?? 'info@sekolah.com' }}</p>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} <strong>{{ $setting->school_name ?? 'SMK Bina Insan Mandiri' }}</strong>. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>