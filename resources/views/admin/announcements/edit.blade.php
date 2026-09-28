@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Edit Pengumuman & Surat Resmi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL PENGUMUMAN</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $announcement->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ISI PENGUMUMAN</label>
                        <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror">{{ old('content', $announcement->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR ILUSTRASI</label>
                                <div class="mb-2">
                                    @if($announcement->image)
                                        <img src="{{ asset('announcements/images/' . $announcement->image) }}" class="rounded shadow-sm" style="max-height: 80px;" alt="Gambar">
                                    @else
                                        <span class="badge badge-secondary">Tidak ada gambar</span>
                                    @endif
                                </div>
                                <input type="file" name="image" class="form-control-file">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">LAMPIRAN SURAT RESMI (PDF / DOC)</label>
                                <div class="mb-2">
                                    @if($announcement->file)
                                        <a href="{{ asset('announcements/files/' . $announcement->file) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-file-alt"></i> Lihat File Saat Ini</a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada file lampiran</span>
                                    @endif
                                </div>
                                <input type="file" name="file" class="form-control-file">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file surat.</small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Perbarui Pengumuman</button>
                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection