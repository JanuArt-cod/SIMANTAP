@extends('layouts.admin')

@section('title', 'Detail Pesan Masuk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Detail Pesan: {{ $message->subject }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Pengirim:</strong>
                        <p class="text-muted">{{ $message->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Alamat Email:</strong>
                        <p class="text-muted"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Waktu Dikirim:</strong>
                        <p class="text-muted">{{ $message->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <div class="form-group">
                    <strong>Isi Pesan:</strong>
                    <div class="p-3 bg-light rounded border mt-2">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('messages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesan</a>
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary"><i class="fas fa-reply"></i> Balas Email</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection