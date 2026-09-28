@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Pengaturan Identitas Website & Sekolah</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA SITUS / WEBSITE</label>
                                <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $setting->site_name) }}" placeholder="Contoh: Portal Resmi Sekolah">
                                @error('site_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA SEKOLAH / LEMBAGA</label>
                                <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror" value="{{ old('school_name', $setting->school_name) }}" placeholder="Contoh: SMK Bina Insan Mandiri">
                                @error('school_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">EMAIL SEKOLAH</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $setting->email) }}" placeholder="info@sekolah.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NOMOR TELEPON / KONTAK</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $setting->phone) }}" placeholder="021-xxxxxxxx">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">LOGO SEKOLAH</label>
                        <div class="mb-2">
                            @if($setting->logo)
                                <img src="{{ asset('logo/' . $setting->logo) }}" class="rounded shadow-sm bg-light p-1" style="max-height: 80px;" alt="Logo Sekolah">
                            @else
                                <span class="badge badge-secondary">Belum ada logo diunggah</span>
                            @endif
                        </div>
                        <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror">
                        <small class="text-muted">Logo akan otomatis dikompresi ukurannya agar ringan. Format: JPG, PNG, WEBP.</small>
                        @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ALAMAT LENGKAP</label>
                        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat instansi...">{{ old('address', $setting->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <h5 class="text-success font-weight-bold mb-3"><i class="fas fa-share-alt"></i> Tautan Sosial Media Resmi</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">URL FACEBOOK</label>
                                <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/namasekolah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">URL INSTAGRAM</label>
                                <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/namasekolah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">URL YOUTUBE</label>
                                <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $setting->youtube) }}" placeholder="https://youtube.com/@namasekolah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">URL TIKTOK</label>
                                <input type="url" name="tiktok" class="form-control" value="{{ old('tiktok', $setting->tiktok) }}" placeholder="https://tiktok.com/@namasekolah">
                            </div>
                        </div>
                    </div>

                    <!-- Tambahan Pengaturan Sambutan & Limit -->
                    <hr class="my-4">
                    <h5 class="text-dark mb-3"><i class="fas id-card mr-2"></i> Pengaturan Sambutan Kepala Sekolah</h5>

                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL SAMBUTAN</label>
                        <input type="text" name="welcome_title" class="form-control" value="{{ old('welcome_title', $setting->welcome_title) }}" placeholder="Contoh: Sambutan Kepala Sekolah Resmi">
                    </div>

                    <!-- Tambahan Input Nama & Jabatan Dinamis -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA KEPALA SEKOLAH</label>
                                <input type="text" name="welcome_name" class="form-control" value="{{ old('welcome_name', $setting->welcome_name) }}" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Pd.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">JABATAN</label>
                                <input type="text" name="welcome_position" class="form-control" value="{{ old('welcome_position', $setting->welcome_position) }}" placeholder="Contoh: Kepala Sekolah">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ISI TEKS SAMBUTAN</label>
                        <textarea name="welcome_text" rows="5" class="form-control" placeholder="Tuliskan kata sambutan pimpinan sekolah...">{{ old('welcome_text', $setting->welcome_text) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">FOTO SAMBUTAN (KEPALA SEKOLAH)</label>
                        <div class="mb-2">
                            @if($setting->welcome_image)
                                <img src="{{ asset('logo/' . $setting->welcome_image) }}" class="rounded shadow-sm" style="max-height: 100px;" alt="Welcome Image">
                            @else
                                <span class="badge badge-secondary">Belum ada foto sambutan</span>
                            @endif
                        </div>
                        <input type="file" name="welcome_image" class="form-control-file">
                        <small class="text-muted">Akan otomatis dikompresi agar ringan.</small>
                    </div>

                    

                    <div class="form-group">
                        <label class="font-weight-bold">JUMLAH MAKSIMAL BERITA TAMPIL DI BERANDA (LIMIT)</label>
                        <input type="number" name="posts_limit" class="form-control" value="{{ old('posts_limit', $setting->posts_limit ?? 3) }}" min="1" max="10">
                        <small class="text-muted">Berapa banyak berita terbaru yang ingin ditampilkan di halaman depan.</small>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection