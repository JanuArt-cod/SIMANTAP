@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Pengumuman & Surat Resmi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL PENGUMUMAN</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Pengumuman Libur Hari Raya Idul Fitri">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ISI PENGUMUMAN</label>
                        <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror" placeholder="Tuliskan isi pengumuman secara lengkap...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR ILUSTRASI (OPSIONAL)</label>
                                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                                <small class="text-muted">Format: JPG, PNG, WEBP. Maks: 5MB.</small>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">LAMPIRAN SURAT RESMI (PDF / DOC)</label>
                                <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror">
                                <small class="text-muted">Format: PDF, DOC, DOCX, XLS. Maks: 10MB.</small>
                                @error('file')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Simpan Pengumuman</button>
                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection