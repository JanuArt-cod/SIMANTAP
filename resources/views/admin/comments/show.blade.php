@extends('layouts.admin')

@section('title', 'Detail Komentar Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Detail Komentar</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Pengirim:</strong>
                        <p class="text-muted">{{ $comment->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Alamat Email:</strong>
                        <p class="text-muted"><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Berita yang Dikomentari:</strong>
                        <p class="text-primary fw-bold">{{ $comment->post->title ?? 'Berita Telah Dihapus' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Waktu Komentar:</strong>
                        <p class="text-muted">{{ $comment->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <div class="form-group">
                    <strong>Isi Komentar:</strong>
                    <div class="p-3 bg-light rounded border mt-2">
                        {!! nl2br(e($comment->comment)) !!}
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('comments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Komentar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection