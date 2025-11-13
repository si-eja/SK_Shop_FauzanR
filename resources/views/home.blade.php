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
                <div class="rounded shadow" style="height: 300px;">

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