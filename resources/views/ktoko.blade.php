@extends('template')
@section('content')
<div class="container">
    <div class="row bg bg-light ">
        <div class="col-md-8 py-1 px-2">
            <div class="bg bg-primary rounded p-2">
                <div class="bg bg-light rounded">
                    <div class="p-2 d-flex justify-content-between">
                        <div class="d-flex gap-2">
                            <img src="{{ asset('storage/toko-img/'.$toko->gambar) }}" alt="" class="rounded" style="object-fit: cover; width: 180px; height: 180px;">
                            <div class="d-flex flex-column">
                                <h3 class="mb-3">{{ $toko->nama_toko }}</h3>
                                <span class="mb-1"><i class="fa-solid fa-user"></i> {{ $toko->user->name }}</span>
                                <span class="mb-1"><i class="fa-solid fa-phone"></i> {{ $toko->nomor }}</span>
                                <span class="mb-1"><strong class="fw-bold">Alamat: </strong>{{ $toko->alamat }}</span>
                                <span class="mb-1"><strong class="fw-bold">Deskripsi: </strong>{{ $toko->deskripsi }}</span>
                            </div>
                        </div>
                        <div class="card p-1 d-flex flex-column justify-content-between">
                            <strong class="rounded bg bg-primary text-white text-center">Produk: {{ $toko->produk->count() }}</strong>
                            <a href="https://wa.me/{{ $toko->nomor }}" class="btn btn-success mb-0">Hubungi penjual</a>
                        </div>
                    </div>
                    <hr class="text-dark p-1">
                    <span class="rounded bg bg-success p-1 w-100 text-white m-2">Produk: {{ $toko->nama_toko }}</span>
                    <div class="p-2">
                        {{-- NAV KATEGORI TOKO --}}
                        <ul class="nav nav-pills mb-3 gap-2 flex-nowrap w-100"
                            id="kategoriTabs"
                            style="overflow-x: auto; white-space: nowrap;">
                            @foreach ($katToko as $item)
                                <li class="nav-item">
                                    <button class="nav-link"
                                        data-kategori="{{ $item->id }}">
                                        {{ $item->nama_kategori }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        {{-- PRODUK CARD --}}
                        <div class="row g-3" id="produkContainer">
                            @foreach ($toko->produk as $item)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 produk-item"
                                data-kat="{{ $item->kategori_id }}">
                                <div class="card shadow-sm h-100">
                                    {{-- GAMBAR --}}
                                    @if ($item->gambar->first())
                                    <img src="{{ asset('storage/img-prod/' . $item->gambar->first()->nama_gambar) }}"
                                        class="card-img-top"
                                        style="height: 180px; object-fit: cover;">
                                    @else
                                    <div class="bg bg-secondary d-flex text-center justify-content-center align-items-center rounded-top"
                                        style="height: 180px">
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
        </div>
        <div class="col-md-4 py-1 px-2">
            <div class="bg bg-primary rounded p-1">
                @foreach ($tokos as $item)
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