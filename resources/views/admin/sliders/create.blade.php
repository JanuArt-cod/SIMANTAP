@extends('layouts.admin')

@section('title', 'Tambah Slider Banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Slider Banner</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL BANNER (OPSIONAL)</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Selamat Datang di Tahun Ajaran Baru">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">SUBJUDUL (OPSIONAL)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="Contoh: Unggul dalam Prestasi, Berkarakter & Islami">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">GAMBAR BANNER</label>
                        <input type="file" name="image" class="form-control-file" required>
                        <small class="text-muted">Rekomendasi ukuran lebar besar (landscape). Akan otomatis dikompresi.</small>
                    </div>
                    <div class="form-group">
                        <div class="control-label font-weight-bold">STATUS TAMPIL</div>
                        <label class="custom-switch mt-2">
                            <input type="checkbox" name="is_active" value="1" class="custom-switch-input" checked>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Aktifkan slider ini di halaman depan</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Slider</button>
                    <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection