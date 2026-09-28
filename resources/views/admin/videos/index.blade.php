@extends('layouts.admin')

@section('title', 'Galeri Video')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Galeri Video (YouTube, TikTok, IG Reels)</h4>
                <div class="card-header-action">
                    <a href="{{ route('videos.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Video</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('videos.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari judul video..." value="{{ request('q') }}">
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
                                <th>Judul Video</th>
                                <th>Link / URL Sumber</th>
                                <th>Deskripsi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($videos as $no => $video)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($videos->currentPage()-1) * $videos->perPage() }}</td>
                                <td class="align-middle fw-bold">{{ $video->title }}</td>
                                <td class="align-middle">
                                    <a href="{{ $video->url }}" target="_blank" class="text-primary text-break"><i class="fas fa-external-link-alt mr-1"></i> {{ Str::limit($video->url, 40) }}</a>
                                </td>
                                <td class="align-middle">{{ Str::limit($video->description, 40) ?: '-' }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada galeri video yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $videos->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection