<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; {{ $setting->site_name ?? 'Admin Sekolah' }}</title>
    <!-- Tambahkan Favicon Logo di sini -->
        @if($setting && $setting->logo)
            <link rel="icon" href="{{ asset('logo/' . $setting->logo) }}" type="image/png">
        @endif

    <!-- General CSS Files (Bootstrap 4 & FontAwesome) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Template CSS Stisla -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg" style="background-color: #198754;"></div>
            
            <!-- Navbar Atas -->
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=198754" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Halo, {{ Auth::user()->name }}</div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar Menu Kiri -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}">
                            @if($setting && $setting->logo)
                                <img src="{{ asset('logo/' . $setting->logo) }}" alt="Logo" style="max-height: 35px;" class="mr-1">
                            @endif
                            <span class="align-middle">{{ $setting->school_name ?? 'PANEL ADMIN' }}</span>
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('admin.dashboard') }}">
                            @if($setting && $setting->logo)
                                <img src="{{ asset('logo/' . $setting->logo) }}" alt="Logo" style="max-height: 30px;">
                            @else
                                PA
                            @endif
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="/admin/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ request()->is('admin/pages*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pages.index') }}"><i class="fas fa-file-alt"></i> <span>Profil Sekolah</span></a></li>
                        
                        <li class="menu-header">Manajemen Konten</li>
                        <li class="{{ request()->is('admin/sliders*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sliders.index') }}"><i class="fas fa-images"></i> <span>Slider Banner</span></a></li>
                        <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-folder"></i> <span>Kategori Berita</span></a></li>
                        <li class="{{ request()->is('admin/posts*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('posts.index') }}"><i class="fas fa-newspaper"></i> <span>Berita & Posts</span></a></li>
                        <li class="{{ request()->is('admin/agendas*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('agendas.index') }}"><i class="fas fa-calendar-alt"></i> <span>Agenda / Events</span></a></li>
                        <li class="{{ request()->is('admin/photos*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('photos.index') }}"><i class="fas fa-images"></i> <span>Galeri Foto</span></a></li>
                        <li class="{{ request()->is('admin/videos*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('videos.index') }}"><i class="fas fa-video"></i> <span>Galeri Video</span></a></li>
                        <li class="{{ request()->is('admin/announcements*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('announcements.index') }}"><i class="fas fa-bullhorn"></i> <span>Pengumuman</span></a></li>

                        <li class="menu-header">Manajemen Pesan</li>
                        <li class="{{ request()->is('admin/messages*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('messages.index') }}"><i class="fas fa-envelope"></i> <span>Pesan Masuk</span></a></li>
                        <li class="{{ request()->is('admin/comments*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('comments.index') }}"><i class="fas fa-comments"></i> <span>Komentar Berita</span></a></li>

                        <li class="menu-header">Pengaturan Hak Akses</li>
                        <li class="{{ request()->is('admin/roles*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-users-cog"></i> <span>Roles</span></a></li>
                        <li class="{{ request()->is('admin/permissions*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('permissions.index') }}"><i class="fas fa-key"></i> <span>Permissions</span></a></li>
                        <li class="{{ request()->is('admin/users*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Manajemen User</span></a></li>

                        <li class="menu-header">Pengaturan Sistem</li>
                        <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i> <span>Pengaturan Website</span></a></li>
                        <li class="{{ request()->is('admin/sections*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sections.index') }}"><i class="fas fa-th-large"></i> <span>Atur Tata Letak Beranda</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- Bagian Konten Utama Dinamis -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title')</h1>
                    </div>
                    
                    <div class="section-body">
                        <!-- TAMBAHKAN KODE ALERT DI SINI -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                                </div>
                            </div>
                        @endif
                        <!-- END ALERT -->
                        @yield('content')
                    </div>
                </section>
            </div>
            
            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2026 <div class="bullet"></div> {{ $setting->school_name ?? 'Segera Tambahkan nama sekolah!' }}
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    
    <!-- Template JS Stisla -->
    <script src="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/stisla@2.3.0/assets/js/custom.js"></script>
</body>
</html>