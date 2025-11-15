@extends('templog')
@section('login')
<div class="container-fluid">
    <div class="container">
        <div class="justify-content-center my-5">
            <div class="row g-0">
                <!-- Kolom kiri (gambar) -->
                <div class="col-md-6 position-relative">
                    <!-- Gambar -->
                    <img src="{{ asset('Pasar.jpg') }}" 
                        alt="Pasar"
                        class="img-fluid"
                        style="width: 100%; height: 100%; object-fit: cover;">

                    <!-- Overlay gelap -->
                    <div style="
                        position: absolute;
                        top: 0; 
                        left: 0; 
                        width: 100%; 
                        height: 100%;
                        background: rgba(0,0,0,0.45);
                    "></div>

                    <!-- Teks di atas gambar -->
                    <div style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        text-align: center;
                        color: white;
                    ">
                        <h1 class="fw-bold" style="text-shadow: 0 0 10px rgba(0,0,0,0.7);">
                            Selamat Datang
                        </h1>
                        <p style="font-size: 1.1rem; text-shadow: 0 0 8px rgba(0,0,0,0.7);">
                            Masuk untuk mengakses halaman toko milik Anda dan fitur berjualan di website ini
                        </p>
                    </div>
                </div>
                <!-- Kolom kanan (form login) -->
                <div class="col-md-6 p-4 bg-primary d-flex flex-column justify-content-center">
                    <div class="header-section d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-white text-shadow m-0">Membuat Akun</h2>
                        <a href="/" class="text-white text-decoration-none fw-semibold small opacity-75 hover-opacity">
                            kembali
                        </a>
                    </div>
                    <form action="" method="get">
                        <label class="fw-bold text-white text-shadow">Username</label>
                        <input type="text" class="form-control mb-2">
                        <label class="fw-bold text-white text-shadow">kontak</label>
                        <input type="text" class="form-control mb-2">
                        <label class="fw-bold text-white text-shadow">Password</label>
                        <input type="password" class="form-control mb-2">
                        <div class="text-start mb-3">
                            <a href="/login" class="text-white text-decoration-none">Sudah punya akun? Login disini</a>
                        </div>
                        <button class="btn btn-light fw-bold w-100 mb-4">Daftar</button>
                        <div class="d-flex align-items-center mb-4">
                            <hr class="flex-grow-1 border-white">
                            <span class="px-2 text-white fw-bold">atau</span>
                            <hr class="flex-grow-1 border-white">
                        </div>
                        <button type="button" class="btn btn-light w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="fab fa-google fa-lg"></i>
                            <span class="fw-bold">Login dengan Google</span>
                        </button>
                        <button type="button" class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="fab fa-apple fa-lg"></i>
                            <span class="fw-bold">Login dengan Apple</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection