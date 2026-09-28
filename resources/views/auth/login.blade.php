<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &mdash; {{ $setting->site_name ?? 'Admin Sekolah' }}</title>
    <!-- Tambahkan Favicon Logo di sini -->
        @if($setting && $setting->logo)
            <link rel="icon" href="{{ asset('logo/' . $setting->logo) }}" type="image/png">
        @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-success">{{ $setting->school_name ?? 'Segera Tambahkan nama sekolah!' }}</h4>
                            <p class="text-muted">Silakan login untuk masuk ke panel admin.</p>
                        </div>

                        <!-- Menampilkan pesan error jika login gagal -->
                        @if($errors->any())
                            <div class="alert alert-danger small">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="/login" method="POST">
                            @csrf <!-- Ini wajib di Laravel untuk keamanan form -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" name="email" class="form-control" placeholder="admin@sekolah.com" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 fw-semibold">Login Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>