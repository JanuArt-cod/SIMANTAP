@extends('layouts.admin')

@section('title', 'Manajemen Agenda')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Agenda & Kegiatan Sekolah</h4>
                <div class="card-header-action">
                    <a href="{{ route('agendas.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Agenda</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('agendas.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari nama agenda..." value="{{ request('q') }}">
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
                                <th>Judul Agenda</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Lokasi</th>
                                <th>Tipe</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($agendas as $no => $agenda)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($agendas->currentPage()-1) * $agendas->perPage() }}</td>
                                <td class="align-middle fw-bold">{{ $agenda->title }}</td>
                                <td class="align-middle">{{ date('d M Y', strtotime($agenda->start_date)) }}</td>
                                <td class="align-middle">{{ $agenda->location }}</td>
                                <td class="align-middle"><span class="badge badge-warning">{{ $agenda->type }}</span></td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('agendas.edit', $agenda->id) }}" class="btn btn-sm btn-primary mb-1"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data agenda belum tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $agendas->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection