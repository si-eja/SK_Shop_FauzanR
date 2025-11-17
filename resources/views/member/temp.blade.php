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
                <h4 data-aos="fade-down" class="neon-text">TokoSK</h4>
            </div>
        </div>
    </div>
    @yield('toko')
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
</script>