@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Edit Galeri Foto</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL / NAMA KEGIATAN</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $photo->title) }}" placeholder="Masukkan judul foto">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">FILE FOTO</label>
                        <div class="mb-2">
                            <img src="{{ asset('photos/' . $photo->image) }}" class="rounded shadow-sm" style="width: 150px; height: 90px; object-fit: cover;" alt="Current Photo">
                        </div>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Foto baru juga akan otomatis dikompresi.</small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESKRIPSI (OPSIONAL)</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Keterangan tambahan...">{{ old('description', $photo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Perbarui Foto</button>
                    <a href="{{ route('photos.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection