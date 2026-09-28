@extends('layouts.admin')

@section('title', 'Dashboard Statistik')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Berita</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Agenda</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-images"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Galeri</h4>
                </div>
                <div class="card-body">
                    0
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pengguna</h4>
                </div>
                <div class="card-body">
                    1
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Selamat Datang!</h4>
            </div>
            <div class="card-body">
                <p>Halo <strong>{{ Auth::user()->name }}</strong>, selamat datang di Panel Admin. Di sini Anda dapat mengelola seluruh konten website mulai dari berita, agenda, galeri, hingga hak akses pengguna.</p>
                <p>Silakan gunakan menu navigasi di sebelah kiri untuk mulai mengelola website Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection