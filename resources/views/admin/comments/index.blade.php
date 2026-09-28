@extends('layouts.admin')

@section('title', 'Komentar Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Komentar pada Berita</h4>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('comments.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari nama pengirim atau isi komentar..." value="{{ request('q') }}">
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
                                <th>Pengirim</th>
                                <th>Berita Terkait</th>
                                <th>Isi Komentar</th>
                                <th width="12%" class="text-center">Status</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $no => $comment)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($comments->currentPage()-1) * $comments->perPage() }}</td>
                                <td class="align-middle">
                                    <strong>{{ $comment->name }}</strong><br>
                                    <small class="text-muted">{{ $comment->email }}</small>
                                </td>
                                <td class="align-middle text-primary fw-semibold">{{ Str::limit($comment->post->title ?? 'Berita Dihapus', 30) }}</td>
                                <td class="align-middle">{{ Str::limit($comment->comment, 40) }}</td>
                                <td class="text-center align-middle">
                                    @if($comment->is_approved)
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <!-- Tombol Publish / Unpublish -->
                                    <form action="{{ route('comments.toggle', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($comment->is_approved)
                                            <button type="submit" class="btn btn-sm btn-warning mb-1" title="Sembunyikan Komentar"><i class="fas fa-eye-slash"></i> Unpublish</button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success mb-1" title="Publikasikan Komentar"><i class="fas fa-check"></i> Publish</button>
                                        @endif
                                    </form>

                                    <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-sm btn-info mb-1"><i class="fas fa-eye"></i> Detail</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada komentar berita yang masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $comments->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection