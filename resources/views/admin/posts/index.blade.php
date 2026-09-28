@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Berita Sekolah</h4>
                <div class="card-header-action">
                    <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Berita</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari judul berita..." value="{{ request('q') }}">
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
                                <th width="12%" class="text-center">Gambar</th>
                                <th>Judul Berita</th>
                                <th width="15%">Kategori</th>
                                <th width="15%">Penulis</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $no => $post)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($posts->currentPage()-1) * $posts->perPage() }}</td>
                                <td class="text-center align-middle">
                                    <img src="{{ asset('posts/' . $post->image) }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;" alt="Thumbnail">
                                </td>
                                <td class="align-middle fw-bold">{{ $post->title }}</td>
                                <td class="align-middle"><span class="badge badge-info">{{ $post->category->name }}</span></td>
                                <td class="align-middle">{{ $post->user->name }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data berita belum tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $posts->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection