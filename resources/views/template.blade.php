<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TokoSK</title>
    <link rel="stylesheet" href="{{ asset('Boostrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('aos-master/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container-fluid bg bg-primary">
        <div class="row">
            <div class="col text-center p-4">
                <h4 data-aos="fade-down" class="neon-text">Selamat Datang di TokoSK</h4>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler bg bg-success mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg bg-primary rounded-2 p-2 border border-dark" id="navmenu">
            <ul class="navbar-nav me-auto">
                @if (Auth::check())
                    @php
                        $toko = Auth::user()->toko;
                        $isKosong = $toko && 
                                    $toko->nama_toko == '-' && 
                                    $toko->gambar == '-' && 
                                    $toko->alamat == '-';
                    @endphp
                    <a class="btn border border-primary text-primary bg-light"
                    href="{{ $isKosong 
                                ? route('tokoM',Crypt::encrypt($toko->id))
                                : route('tokoM', Crypt::encrypt($toko->id)) }}">
                        {{ $isKosong ? 'Buka Toko' : 'Kelola Toko' }}
                    </a>
                @else   
                    <li class="nav-item me-1">
                        <div class="d-flex">
                            <a class="btn btn-light border border-success text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Daftar untuk membuat toko sendiri" href="/regis">Daftar</a>
                            <a class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Masuk untuk mengakses toko anda" href="/login">Masuk</a>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Toko</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Produk</a>
                </li>
            </ul>
            <form class="d-flex" id="search">
                <input class="form-control me-2" type="text" placeholder="cari....">
                <button class="btn btn-success" type="button">Cari</button>
            </form>
            </div>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <footer class="bg-primary text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <h5 class="mb-0">Informasi</h5>
                    <hr>
                    <p class="mb-0 small">
                        TokoSK adalah platform e-commerce inovatif yang menyediakan berbagai lapak toko online,
                        Temukan produk dari berbagai penjual terpercaya, mulai dari fashion, elektronik, hingga
                        kebutuhan rumah tangga.
                    </p>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-8 row">
                            <div class="col-7">
                                <h5 class="mb-0">Ikuti kami</h5>
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-3">
                                        <a href="#" class="text-light text-decoration-none">
                                            <i class="fab fa-facebook fa-2x"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="text-light text-decoration-none">
                                            <i class="fab fa-twitter fa-2x"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="text-light text-decoration-none">
                                            <i class="fab fa-instagram fa-2x"></i>
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="text-light text-decoration-none">
                                            <i class="fab fa-linkedin fa-2x"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <h5 class="mb-0">Navigasi</h5>
                                <hr>
                                <ul class="list-unstyled justify-content-center gap-3 mb-0">
                                    <li><a href="#" class="text-light text-decoration-none">Toko</a></li>
                                    <li><a href="#" class="text-light text-decoration-none">Produk</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Kontak Pusat</h5>
                            <hr>
                            <p class="mb-0 small">
                                Email: <a href="mailto:info@tokosk.com" class="text-light text-decoration-none">info@tokosk.com</a><br>
                                Telepon: <a href="tel:+6281234567890" class="text-light text-decoration-none">+62 812-3456-7890</a><br>
                                Alamat: Jl. Raya No. 123, Kota XYZ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="container-fluid p-4 text-center bg bg-dark">
        <p class="mb-1 text-white">&copy; {{ date('Y') }} TokoSK. All rights reserved.</p>
    </div>
</body>
</html>
<script src="{{ asset('Boostrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('aos-master/dist/aos.js') }}"></script>
<script>
    AOS.init();
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>