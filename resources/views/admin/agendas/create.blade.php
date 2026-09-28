@extends('layouts.admin')

@section('title', 'Tambah Agenda Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Agenda</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agendas.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL AGENDA</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Ujian Tengah Semester (UTS) Ganjil">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL PELAKSANAAN</label>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">JAM / WAKTU</label>
                                <input type="text" name="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}" placeholder="Contoh: 07:30 - 12:00 WIB">
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">LOKASI / TEMPAT</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="Contoh: Ruang Kelas Masing-masing">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">TIPE / KATEGORI AGENDA</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="Ujian" {{ old('type') == 'Ujian' ? 'selected' : '' }}>Ujian</option>
                                    <option value="Kegiatan" {{ old('type') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan / Event</option>
                                    <option value="Rapat" {{ old('type') == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESKRIPSI LENGKAP</label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Tuliskan keterangan detail mengenai agenda...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Simpan Agenda</button>
                    <a href="{{ route('agendas.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection