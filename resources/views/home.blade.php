@extends('template')
@section('content')
{{-- Toko --}}
<div class="container-fluid">
    <div class="container w-100 py-3">
        <div class="rounded text-center text-shadow text-light py-4 px-2" style="background: url({{ asset('asset/Toko.png') }}) center/cover no-repeat;">
            <h2>Tentang kami</h2>
            <p>Kami adalah platform toko online yang memberikan kebebasan bagi setiap pengguna untuk berjualan sesuai dengan kreativitas dan keinginan mereka. Dengan tetap mengedepankan aturan serta etika bertransaksi yang berlaku, kami berkomitmen menciptakan lingkungan jual beli yang aman, tertib, dan saling menguntungkan bagi seluruh pengguna.</p>
        </div>
        <div class="rounded bg-light shadow row py-4 mx-0 mt-3">
            <div class="col-md-4">
                <h2>Rekomendasi Toko</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
            <div class="col-md-8">
                <div class="rounded shadow row py-2" style="height: 360px;">
                    <div class="col-3">
                        <div class="rounded-1 bg bg-light border border-primary">
                            <div class="bg bg-success rounded-top-1" style="width: 100%; height: 180px;"></div>
                            <div class="m-1">
                                <div class="d-flex justify-content-between">
                                    <label for="" class="text-black fw-bold">Toko A</label>
                                    <p><i class=""></i></p>
                                </div>
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