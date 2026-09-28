@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Edit Agenda</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agendas.update', $agenda->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL AGENDA</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $agenda->title) }}" placeholder="Masukkan judul agenda">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL PELAKSANAAN</label>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $agenda->start_date) }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">JAM / WAKTU</label>
                                <input type="text" name="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $agenda->time) }}" placeholder="07:30 - 12:00 WIB">
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
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $agenda->location) }}" placeholder="Lokasi kegiatan">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">TIPE / KATEGORI AGENDA</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="Ujian" {{ old('type', $agenda->type) == 'Ujian' ? 'selected' : '' }}>Ujian</option>
                                    <option value="Kegiatan" {{ old('type', $agenda->type) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan / Event</option>
                                    <option value="Rapat" {{ old('type', $agenda->type) == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">DESKRIPSI LENGKAP</label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Tuliskan keterangan detail...">{{ old('description', $agenda->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Perbarui Agenda</button>
                    <a href="{{ route('agendas.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection