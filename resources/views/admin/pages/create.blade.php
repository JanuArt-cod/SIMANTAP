@extends('layouts.admin')

@section('title', 'Tambah Halaman Profil')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Halaman Profil Baru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pages.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL HALAMAN</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Sejarah Singkat Sekolah atau Visi & Misi">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ISI KONTEN HALAMAN</label>
                        <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Tuliskan isi informasi secara lengkap di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Simpan Halaman</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection