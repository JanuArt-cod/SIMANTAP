@extends('layouts.admin')

@section('title', 'Tambah Foto Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Upload Foto (Auto-Compress)</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL / NAMA KEGIATAN</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Upacara Bendera Senin Pagi">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">PILIH FILE FOTO</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                        <small class="text-muted">Gambar akan otomatis dikompresi agar ukuran file menjadi kecil dan ringan saat disimpan.</small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESKRIPSI (OPSIONAL)</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Keterangan tambahan tentang foto...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-upload"></i> Unggah & Kompres Foto</button>
                    <a href="{{ route('photos.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection