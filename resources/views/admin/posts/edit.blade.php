@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Edit Berita</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL BERITA</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" placeholder="Masukkan judul berita utama">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR UTAMA (THUMBNAIL)</label>
                                <div class="mb-2">
                                    <img src="{{ asset('posts/' . $post->image) }}" class="rounded shadow-sm" style="width: 120px; height: 70px; object-fit: cover;" alt="Current Image">
                                </div>
                                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ISI KONTEN BERITA</label>
                        <textarea name="content" rows="8" class="form-control @error('content') is-invalid @enderror" placeholder="Tuliskan isi berita secara lengkap di sini...">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Perbarui Berita</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection