@extends('layouts.admin')

@section('title', 'Tambah Role Baru')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Form Tambah Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">NAMA ROLE</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan Nama Role (Contoh: Guru)">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">PERMISSIONS (HAK AKSES)</label>
                        <br>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-3 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="custom-control-input" id="check-{{ $permission->id }}">
                                        <label class="custom-control-label" for="check-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-1"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection