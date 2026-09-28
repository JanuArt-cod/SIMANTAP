@extends('layouts.admin')

@section('title', 'Atur Tata Letak Beranda')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Atur Urutan & Tampilan Konten Beranda</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Ubah angka pada kolom <strong>Urutan</strong> untuk menentukan posisi tampil di halaman utama (Contoh: 1 tampil paling atas, 2 tampil setelahnya, dst.). Anda juga bisa menonaktifkan bagian tertentu agar tidak muncul di website.
                </p>

                <form action="{{ route('sections.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th width="15%" class="text-center">Urutan (Prioritas)</th>
                                    <th>Nama Bagian (Section)</th>
                                    <th>Kunci Sistem</th>
                                    <th width="20%" class="text-center">Status Tampil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                <tr>
                                    <td class="text-center align-middle">
                                        <input type="number" name="order[{{ $section->id }}]" value="{{ $section->order }}" class="form-control text-center font-weight-bold" min="1" max="10" required>
                                    </td>
                                    <td class="align-middle font-weight-bold text-dark">
                                        {{ $section->name }}
                                    </td>
                                    <td class="align-middle">
                                        <code>{{ $section->key }}</code>
                                    </td>
                                    <td class="text-center align-middle">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="is_active[{{ $section->id }}]" value="1" class="custom-switch-input" {{ $section->is_active ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $section->is_active ? 'Aktif' : 'Disembunyikan' }}</span>
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Simpan Perubahan Urutan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection