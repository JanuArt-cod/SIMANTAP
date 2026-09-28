@extends('layouts.admin')

@section('title', 'Manajemen Halaman Profil')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Halaman Profil Sekolah (Sejarah, Visi Misi, dll)</h4>
                <div class="card-header-action">
                    <a href="{{ route('pages.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Halaman</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Judul Halaman</th>
                                <th width="25%">Slug URL</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pages as $no => $page)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($pages->currentPage()-1) * $pages->perPage() }}</td>
                                <td class="align-middle font-weight-bold">{{ $page->title }}</td>
                                <td class="align-middle text-muted">/profil/{{ $page->slug }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada halaman profil yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $pages->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection