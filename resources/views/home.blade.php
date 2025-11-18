@extends('template')
@section('content')
{{-- Produk --}}
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
                <h2>Produk Terbaru</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    @foreach ($produk as $item)
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            {{-- <img src="{{ asset($item->gambar) }}" alt="" class="rounded-top"> --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                <p class="card-text mb-1">{{ $item->harga }}</p>
                                <p class="card-text mb-3">{{ $item->kategori }}</p>
                                <a href="#" class="btn btn-primary w-100">Kunjungi Toko</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Kategori --}}
<div class="container-fluid bg-primary" style="height: 500px;">
    <div class="container">
        
    </div>
</div>
{{-- Toko --}}
<div class="container-fluid bg-light py-5">
    <div class="container">
        
    </div>
</div>
<div class="container-fluid bg-primary py-5">
    <div class="container">
        <div class="rounded bg-light shadow row py-4 mx-0">
            <div class="col-md-4">
                <h2>Toko Populer</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    @foreach ($toko as $item)
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset('storage/toko-img/'.$item->gambar) }}" alt="" class="rounded-top object-fit-cover" style="height: 180px">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_toko }}</h5>
                                <p class="card-text mb-1">Pemilik: {{ $item->user->name }}</p>
                                <p class="card-text mb-3">Alamat: {{ $item->alamat }}</p>
                                <a href="#" class="btn btn-primary w-100">Kunjungi Toko</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-light" style="height: 500px;">
    <div class="container">
        
    </div>
</div>
@endsection