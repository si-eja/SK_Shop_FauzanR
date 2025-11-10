<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            <button class="navbar-toggler bg bg-info mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg bg-primary rounded-2 p-2" id="navmenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="btn btn-success" href="#">Masuk</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Toko</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Produk</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="cari....">
                <button class="btn btn-success" type="button">Cari</button>
            </form>
            </div>
        </div>
    </nav>
    <div style="height: 100vh">
        @yield('content')
    </div>
    <footer class="bg-primary text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5 class="mb-0">Informasi</h5>
                    <hr>
                    <p class="mb-0 small">
                        TokoSK adalah platform e-commerce inovatif yang menyediakan berbagai lapak toko online,
                        Temukan produk dari berbagai penjual terpercaya, mulai dari fashion, elektronik, hingga
                        kebutuhan rumah tangga.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Ikuti kami</h5>
                            <hr>
                            <div class="row">
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
                        <div class="col-6">
                            <h5 class="mb-0">Navigasi</h5>
                            <hr>
                            <ul class="list-unstyled justify-content-center gap-3 mb-0">
                                <li><a href="#" class="text-light text-decoration-none">Toko</a></li>
                                <li><a href="#" class="text-light text-decoration-none">Produk</a></li>
                            </ul>
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
</script>