@extends('layouts.admin')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Pengumuman Resmi Sekolah</h4>
                <div class="card-header-action">
                    <a href="{{ route('announcements.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Pengumuman</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('announcements.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari judul pengumuman..." value="{{ request('q') }}">
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
                                <th width="15%" class="text-center">Gambar</th>
                                <th>Judul Pengumuman</th>
                                <th width="15%" class="text-center">Surat Resmi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($announcements as $no => $announcement)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($announcements->currentPage()-1) * $announcements->perPage() }}</td>
                                <td class="text-center align-middle">
                                    @if($announcement->image)
                                        <img src="{{ asset('announcements/images/' . $announcement->image) }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;" alt="Gambar">
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="align-middle fw-bold">{{ $announcement->title }}</td>
                                <td class="text-center align-middle">
                                    @if($announcement->file)
                                        <a href="{{ asset('announcements/files/' . $announcement->file) }}" target="_blank" class="btn btn-sm btn-info mb-1"><i class="fas fa-download"></i> Unduh File</a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada pengumuman yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $announcements->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection