<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Boostrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('aos-master/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <title>TokoSK</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar (Desktop Only) -->
      <div class="col-2 d-none d-lg-block sidebar bg-primary text-white">
        <p class="fs-5 fw-bold text-center mt-3">Admin Menu</p>
        <nav class="nav flex-column px-3">
          <a class="nav-link" href="#">Dashboard</a>
          <a class="nav-link" href="#">Toko</a>
          <a class="nav-link" href="#">Pengguna</a>
          <a class="nav-link" href="#">Produk</a>
        </nav>
        <div class="text-center mt-3 mb-3">
          <a href="#" class="btn btn-danger fw-bold w-100">Logout</a>
        </div>
      </div>
      <!-- Navbar (Mobile Only) -->
      <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white d-lg-none">
        <div class="container-fluid">
          <span class="fs-5 fw-bold">Admin</span>
          <button class="navbar-toggler bg bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Toko</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Pengguna</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Produk</a></li>
              <li class="nav-item mt-2">
                <a href="#" class="btn btn-danger fw-bold w-100">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Main Content -->
      <div class="col-12 col-lg-10 main-content py-4">
        @yield('admin')
      </div>
    </div>
  </div>
</body>
</html>
<script src="{{ asset('Boostrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('aos-master/dist/aos.js') }}"></script>
<script>
    AOS.init();
</script>