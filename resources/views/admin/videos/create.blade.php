@extends('layouts.admin')

@section('title', 'Tambah Video Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Link Video (YouTube / TikTok / IG Reels)</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('videos.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL VIDEO</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Profil Singkat SMK Bina Insan Mandiri">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">LINK / URL VIDEO (YouTube, TikTok, atau Instagram Reels)</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxx atau link Reels/TikTok">
                        <small class="text-muted">Masukkan link lengkap dari video media sosial tersebut.</small>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESKRIPSI (OPSIONAL)</label>
                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Keterangan tambahan tentang video...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Simpan Video</button>
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection