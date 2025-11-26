@extends('template')
@section('content')
{{-- Produk --}}
<div class="container w-100 py-3">
    <div class="rounded bg-light shadow p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-column mb-0">
                <h2>Produk Terbaru</h2>
                <p>Selamat datang di TokoSRC, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
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
                            <a href="{{ route('ProdukD',Crypt::encrypt($item->id)) }}" class="btn btn-light border border-primary text-primary">
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
{{-- Kategori --}}
<div class="container">
    <div class="rounded bg-light shadow p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column mb-3">
                <h2>Kategori</h2>
                <p>Selamat datang di TokoSRC, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
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
                            <a href="{{ route('ProdukD',Crypt::encrypt($item->id)) }}" class="btn btn-light border border-primary text-primary">
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
{{-- Semua Produk --}}
<div class="container mt-3">
    <div class="rounded bg-light shadow p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column mb-3">
                <h2>Semua Produk</h2>
                <p>Selamat datang di TokoSRC, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
        </div>
        <div class="row g-3">
            @foreach ($aProduk as $item)
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
                            <a href="{{ route('ProdukD',Crypt::encrypt($item->id)) }}" class="btn btn-light border border-primary text-primary">
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
@endsection