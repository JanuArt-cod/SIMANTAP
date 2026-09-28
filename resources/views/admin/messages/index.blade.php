@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Pesan Masuk dari Pengunjung</h4>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="{{ route('messages.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari nama pengirim atau subjek..." value="{{ request('q') }}">
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
                                <th>Email</th>
                                <th>Subjek</th>
                                <th width="15%" class="text-center">Waktu</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $no => $message)
                            <tr>
                                <td class="text-center align-middle">{{ ++$no + ($messages->currentPage()-1) * $messages->perPage() }}</td>
                                <td class="align-middle fw-bold">{{ $message->name }}</td>
                                <td class="align-middle">{{ $message->email }}</td>
                                <td class="align-middle">{{ $message->subject }}</td>
                                <td class="text-center align-middle small">{{ $message->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-info mb-1"><i class="fas fa-eye"></i> Detail</a>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pesan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $messages->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection