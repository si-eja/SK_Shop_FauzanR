@extends('template')
@section('content')
@php
    $gambarUtama = $produk->gambar->first();
@endphp
<style>
    .slider-container {
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .slider-btn {
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        z-index: 10;
        border-radius: 50%;
        padding: 10px 15px;
    }

    .prev-btn {
        left: -10px;
    }

    .next-btn {
        right: -10px;
    }

    .slider-btn:hover {
        opacity: 0.8;
    }
</style>
<div class="container">
    <div class="mb-4">
        <div class="row rounded shadow">
            <div class="col-md-6">
                <div class="py-2">
                    <img src="{{ asset('storage/img-prod/'.$produk->gambar->first()->nama_gambar) }}" alt="" class="rounded" style="height: 360px; width: 100%; object-fit: cover;">
                    <div class="row mt-2">
                        @foreach ($produk->gambar as $g)
                        @if ($g->id !== $gambarUtama->id)
                        <div class="col-3">
                            <img src="{{ asset('storage/img-prod/'.$g->nama_gambar) }}" alt="" class="rounded w-100 " style="height: 150px; object-fit: cover;">
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="py-2 h-50 mb-4">
                    <h2 class="fw-bold">{{ $produk->nama_produk }}</h2>
                    <hr>
                    <span class="bg bg-primary rounded p-2 text-white">{{ $produk->kategori->nama_kategori }}</span>
                    <p class="mt-3">harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.wa', $produk->id) }}" class="btn btn-success w-100">Pesan via Whatsapp</a>
                    <p class="fw-bold h5">Deskripsi produk</p>
                    <p>{{ $produk->deskripsi }}</p>
                </div>
                <div class="border border-primary rounded p-2">
                    @if ($produk->toko)
                        <div class="row">
                            <div class="col-md-5">
                                <div class="img-wrapper">
                                    <img src="{{ asset('storage/toko-img/'.$produk->toko->gambar) }}" alt=""class="img-fit">
                                </div>
                            </div>
                            <div class="col-md-7 px-3">
                                <h2><i class="fa-solid fa-shop"></i> {{ $produk->toko->nama_toko }}</h2>
                                <hr>
                                <h6><i class="fa-solid fa-user"></i> {{ $produk->toko->user->name }}</h6>
                                <h6><i class="fa-solid fa-location-dot"></i> {{ $produk->toko->alamat }}</h6>
                            </div>
                        </div>
                        <a href="{{ route('TokoK', Crypt::encrypt($produk->toko->id)) }}"
                        class="btn btn-primary w-100 mt-2">
                            Kunjungi Toko
                        </a>
                    @else
                        <p class="text-muted">Toko tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h4 class="fw-bold mb-3">Produk Lainnya</h4>
        @if ($katProduk->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada produk terkait dalam kategori ini.
            </div>
        @else
            <div class="position-relative">
                <!-- Tombol kiri -->
                <button class="btn btn-primary slider-btn prev-btn">
                    &#10094;
                </button>
                <!-- Wrapper Scroll -->
                <div id="produkSlider" class="d-flex overflow-auto gap-3 slider-container">
                    @foreach ($katProduk as $item)
                        <div class="card shadow-sm" style="min-width: 200px; max-width: 200px;">
                            @if ($item->gambar->first())
                                <img src="{{ asset('storage/img-prod/' . $item->gambar->first()->nama_gambar) }}"
                                    class="card-img-top"
                                    style="height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary d-flex justify-content-center align-items-center rounded-top"
                                    style="height: 150px">
                                    <small class="text-white">Tidak ada gambar</small>
                                </div>
                            @endif
                            <div class="card-body p-2">
                                <h6 class="card-title">{{ $item->nama_produk }}</h6>
                                <p class="mb-1">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('ProdukD', Crypt::encrypt($item->id)) }}" class="btn btn-light border border-primary text-primary w-100 mb-1">
                                    Detail
                                </a>
                                <a href="{{ route('produk.wa', $item->id) }}" class="btn btn-success w-100">
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Tombol kanan -->
                <button class="btn btn-primary slider-btn next-btn">
                    &#10095;
                </button>
            </div>
        @endif
    </div>
</div>
<script>
    const slider = document.getElementById('produkSlider');

    document.querySelector('.next-btn').addEventListener('click', function () {
        slider.scrollLeft += 250;
    });

    document.querySelector('.prev-btn').addEventListener('click', function () {
        slider.scrollLeft -= 250;
    });
</script>
@endsection