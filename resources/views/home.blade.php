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
        <div class="rounded bg-light shadow p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column mb-0">
                    <h2>Produk Terbaru</h2>
                    <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
                </div>
                <a href="#" class="btn btn-light border border-primary text-primary mb-5">Produk lainnya</a>
            </div>
            <div class="row g-3">
                @foreach ($produk as $item)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100">
                        @if ($item->gambar->first())
                            <img src="{{ asset('storage/img-prod/' . $item->gambar->first()->nama_gambar) }}"
                                class="card-img-top"
                                style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg bg-secondary d-flex text-center justify-content-center align-items-center rounded-top" style="height: 180px">
                                <h6>Produk belum memiliki gambar</h6>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_produk }}</h5>
                            <p class="card-text mb-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                            <div class="d-flex gap-2">
                                <p style="font-size: 0.9rem">Stok: {{ $item->stok }}</p>
                                <p class="badge bg-secondary">{{ $item->kategori->nama_kategori }}</p>
                            </div>
                            <div class="d-flex flex-column flex-md-row gap-2 mt-2">
                                <a href="{{ route('produk.wa', $item->id) }}"
                                    class="btn btn-success w-100">
                                    Pesan via Whatsapp
                                </a>
                                <a href="#" class="btn btn-light border border-primary text-primary">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- Kategori --}}
<div class="container-fluid bg-primary py-5">
    <div class="container">
        <div class="rounded bg-light shadow p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column mb-3">
                    <h2>Kategori</h2>
                    <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
                </div>
            </div>
            <ul class="nav nav-pills mb-3 gap-2 flex-nowrap w-100"
                id="kategoriTabs"
                style="overflow-x: auto; white-space: nowrap;">
                @foreach ($kategori as $item)
                    <li class="nav-item">
                        <button class="nav-link"
                            data-kategori="{{ $item->id }}">
                            {{ $item->nama_kategori }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="row g-3" id="produkContainer">
                @foreach ($prodkat as $item)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 produk-item"
                    data-kat="{{ $item->kategori_id }}">
                    <div class="card shadow-sm h-100">
                        @if ($item->gambar->first())
                        <img src="{{ asset('storage/img-prod/' . $item->gambar->first()->nama_gambar) }}"
                            class="card-img-top"
                            style="height: 180px; object-fit: cover;">
                        @else
                        <div class="bg bg-secondary d-flex text-center justify-content-center align-items-center rounded-top" style="height: 180px">
                            <h6>Produk belum memiliki gambar</h6>
                        </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_produk }}</h5>
                            <p class="card-text mb-1">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                            <div class="d-flex gap-2">
                                <p style="font-size: 0.9rem">Stok: {{ $item->stok }}</p>
                                <p class="badge bg-secondary">{{ $item->kategori->nama_kategori }}</p>
                            </div>
                            <div class="d-flex flex-column flex-md-row gap-2 mt-2">
                                <a href="{{ route('produk.wa', $item->id) }}"
                                    class="btn btn-success w-100">
                                    Pesan via Whatsapp
                                </a>
                                <a href="#" class="btn btn-light border border-primary text-primary">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- Toko --}}
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="rounded bg-light shadow p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column mb-3">
                    <h2>Toko Populer</h2>
                    <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
                </div>
                <a href="#" class="btn btn-light border border-primary text-primary mb-5">Toko lainnya</a>
            </div>
            <div class="row">
                @foreach ($toko as $item)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="p-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="img-wrapper">
                                        <img src="{{ asset('storage/toko-img/'.$item->gambar) }}" alt=""
                                            class="img-fit">
                                    </div>
                                </div>
                                <div class="col-md-7 px-3">
                                    <h2><i class="fa-solid fa-shop"></i> {{ $item->nama_toko }}</h2>
                                    <hr>
                                    <h6><i class="fa-solid fa-user"></i> {{ $item->user->name }}</h6>
                                    <h6><i class="fa-solid fa-location-dot"></i> {{ $item->alamat }}</h6>
                                </div>
                            </div>
                            <a href="{{ route('TokoK',Crypt::encrypt($item->id)) }}" class="btn btn-primary w-100 mt-2">Kunjungi Toko</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection