@extends('template')
@section('content')
{{-- Toko --}}
<div class="container-fluid">
    <div class="container w-100 py-3">
        <div class="about-section rounded text-center text-light py-4 px-2">
            <h2>Tentang kami</h2>
            <p>
                Kami adalah platform toko online yang memberikan kebebasan bagi setiap pengguna 
                untuk berjualan sesuai dengan kreativitas dan keinginan mereka. Dengan tetap 
                mengedepankan aturan serta etika bertransaksi yang berlaku, kami berkomitmen 
                menciptakan lingkungan jual beli yang aman, tertib, dan saling menguntungkan 
                bagi seluruh pengguna.
            </p>
        </div>
        <div class="rounded bg-light shadow row py-4 mx-0 mt-3">
            <div class="col-md-4">
                <h2>Rekomendasi Toko</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="bg-secondary" style="height: 160px;"></div>
                            <div class="card-body">
                                <h5 class="card-title">Toko A</h5>
                                <p class="card-text mb-1">Pemilik: Budi Santoso</p>
                                <p class="card-text mb-3">Alamat: Jl. Raya No. 123, Kota XYZ</p>
                                <a href="#" class="btn btn-primary w-100">Kunjungi Toko</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="bg-secondary" style="height: 160px;"></div>
                            <div class="card-body">
                                <h5 class="card-title">Toko A</h5>
                                <p class="card-text mb-1">Pemilik: Budi Santoso</p>
                                <p class="card-text mb-3">Alamat: Jl. Raya No. 123, Kota XYZ</p>
                                <a href="#" class="btn btn-primary w-100">Kunjungi Toko</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="bg-secondary" style="height: 160px;"></div>
                            <div class="card-body">
                                <h5 class="card-title">Toko A</h5>
                                <p class="card-text mb-1">Pemilik: Budi Santoso</p>
                                <p class="card-text mb-3">Alamat: Jl. Raya No. 123, Kota XYZ</p>
                                <a href="#" class="btn btn-primary w-100">Kunjungi Toko</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Kategori --}}
<div class="container-fluid bg-primary text-light" style="height: 500px;">
    <div class="container">

    </div>
</div>
{{-- Produk --}}
<div class="container-fluid" style="height: 500px;">
    <div class="container">

    </div>
</div>
@endsection