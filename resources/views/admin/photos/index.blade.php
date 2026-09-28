@extends('layouts.admin')

@section('title', 'Galeri Foto')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Galeri Foto Kegiatan</h4>
                <div class="card-header-action">
                    <a href="{{ route('photos.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Foto</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('photos.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari judul foto..." value="{{ request('q') }}">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%" class="text-center">Foto</th>
                                <th>Judul / Keterangan Singkat</th>
                                <th>Deskripsi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($photos as $no => $photo)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($photos->currentPage()-1) * $photos->perPage() }}</td>
                                <td class="text-center align-middle">
                                    <img src="{{ asset('photos/' . $photo->image) }}" class="rounded shadow-sm" style="width: 100px; height: 60px; object-fit: cover;" alt="Galeri">
                                </td>
                                <td class="align-middle fw-bold">{{ $photo->title }}</td>
                                <td class="align-middle">{{ Str::limit($photo->description, 50) ?: '-' }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada galeri foto yang diunggah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $photos->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection