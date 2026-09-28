<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageSectionController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita', [PublicController::class, 'posts'])->name('public.posts');
Route::get('/berita/{post:slug}', [PublicController::class, 'showPost'])->name('public.posts.show');
Route::post('/berita/{post}/komentar', [PublicController::class, 'storeComment'])->name('public.comments.store');
Route::get('/kontak', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/kontak', [PublicController::class, 'storeMessage'])->name('public.messages.store');
Route::get('/pengumuman/{slug}', [App\Http\Controllers\PublicController::class, 'showAnnouncement'])->name('public.announcements.show');
Route::get('/profil/{slug}', [App\Http\Controllers\PublicController::class, 'showPage'])->name('public.pages.show');

// Route untuk Authentication (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

// Route untuk Logout (Hanya bisa diakses jika sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Route Permissions (Hanya index)
    Route::resource('permissions', PermissionController::class)->only(['index']);
    
    // Route Roles (Full CRUD)
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class); // <-- Tambahkan ini
    Route::resource('posts', PostController::class);
    Route::resource('agendas', AgendaController::class);
    Route::resource('photos', PhotoController::class);
    Route::resource('videos', VideoController::class);
    // Route Pesan Masuk (Kecuali create, store, edit, update)
    Route::resource('messages', MessageController::class)->except(['create', 'store', 'edit', 'update']);
    // Route Komentar Berita
    Route::patch('comments/{comment}/toggle', [CommentController::class, 'toggleApprove'])->name('comments.toggle');
    Route::resource('comments', CommentController::class)->only(['index', 'show', 'destroy']);

    // Route Pengaturan Website (Hanya index dan update)
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('sliders', SliderController::class);

    Route::get('sections', [HomepageSectionController::class, 'index'])->name('sections.index');
    Route::put('sections/update', [HomepageSectionController::class, 'update'])->name('sections.update');
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
    
});