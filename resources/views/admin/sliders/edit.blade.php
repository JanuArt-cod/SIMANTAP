@extends('layouts.admin')

@section('title', 'Edit Slider Banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Edit Slider Banner</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL BANNER</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">SUBJUDUL</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle) }}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">GAMBAR BANNER</label>
                        <div class="mb-2">
                            <img src="{{ asset('sliders/' . $slider->image) }}" class="rounded shadow-sm" style="width: 150px; height: 80px; object-fit: cover;" alt="Slider">
                        </div>
                        <input type="file" name="image" class="form-control-file">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                    <div class="form-group">
                        <div class="control-label font-weight-bold">STATUS TAMPIL</div>
                        <label class="custom-switch mt-2">
                            <input type="checkbox" name="is_active" value="1" class="custom-switch-input" {{ $slider->is_active ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Aktifkan slider ini di halaman depan</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui Slider</button>
                    <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection