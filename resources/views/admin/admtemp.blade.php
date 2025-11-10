<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Boostrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('aos-master/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Document</title>
</head>
<body>
    <!-- Sidebar Menu untuk Desktop -->
    <div class="sidebar bg bg-primary text-white">
        <p class="fs-3 fw-bold">Admin menu</p>
        <nav class="nav flex-column">
            <a class="nav-link" href="#">Dashboard</a>
            <a class="nav-link" href="#">Toko</a>
            <a class="nav-link" href="#">Pengguna</a>
            <a class="nav-link" href="#">Produk</a>
        </nav>
        <!-- Tombol Logout di bawah menu -->
        <div class="logout-btn">
            <a href="#" class="btn bg-danger fw-bold text-white text-center w-100">Logout</a>
        </div>
    </div>
    <!-- Navbar untuk Mobile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white">
        <div class="container-fluid">
            <p class="fs-3 fw-bold">Admin menu</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <!-- Tombol Logout di bawah menu -->
                    <li class="nav-item logout-btn mb-auto">
                        <a href="#" class="btn bg-danger fw-bold text-white text-center w-100">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container main-content">
        @yield('admin')
    </div>
</body>
</html>
<script src="{{ asset('Boostrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('aos-master/dist/aos.js') }}"></script>
<script>
    AOS.init();
</script>