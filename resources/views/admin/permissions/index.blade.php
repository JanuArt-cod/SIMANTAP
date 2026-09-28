@extends('layouts.admin')

@section('title', 'Data Permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Daftar Hak Akses (Permissions)</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permissions.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari permission..." value="{{ request('q') }}">
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
                                <th>Nama Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $no => $permission)
                            <tr>
                                <td class="text-center">{{ ++$no + ($permissions->currentPage()-1) * $permissions->perPage() }}</td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Data permission belum tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $permissions->appends(['q' => request('q')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection