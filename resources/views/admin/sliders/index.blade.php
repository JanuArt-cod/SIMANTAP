@extends('layouts.admin')

@section('title', 'Manajemen Slider Banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Slider Banner Beranda</h4>
                <div class="card-header-action">
                    <a href="{{ route('sliders.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Slider</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="20%" class="text-center">Gambar Banner</th>
                                <th>Judul Slider</th>
                                <th>Subjudul</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $no => $slider)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no }}</td>
                                <td class="text-center align-middle">
                                    <img src="{{ asset('sliders/' . $slider->image) }}" class="rounded shadow-sm" style="width: 120px; height: 60px; object-fit: cover;" alt="Slider">
                                </td>
                                <td class="align-middle fw-bold">{{ $slider->title ?: '-' }}</td>
                                <td class="align-middle">{{ $slider->subtitle ?: '-' }}</td>
                                <td class="text-center align-middle">
                                    @if($slider->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada slider banner.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection