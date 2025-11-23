@extends('template')
@section('content')
<div class="container">
    <div class="rounded bg-light shadow p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column mb-3">
                <h2>Toko Populer</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
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
    <div class="rounded bg-light shadow p-4 my-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column mb-3">
                <h2>Semua Toko</h2>
                <p>Selamat datang di TokoSK, tempat terbaik untuk membeli berbagai macam produk yang berkualitas</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($aToko as $item)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="p-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="img-wrapper">
                                    <img src="{{ asset('storage/toko-img/'.$item->gambar) }}" 
                                        alt="" 
                                        class="img-fit w-100 rounded">
                                </div>
                            </div>

                            <div class="col-7 px-3">
                                <h5 class="fw-bold">
                                    <i class="fa-solid fa-shop"></i> {{ $item->nama_toko }}
                                </h5>
                                <hr class="my-1">
                                <p class="mb-1"><i class="fa-solid fa-user"></i> {{ $item->user->name }}</p>
                                <p class="mb-1"><i class="fa-solid fa-location-dot"></i> {{ $item->alamat }}</p>
                            </div>
                        </div>

                        <a href="{{ route('TokoK', Crypt::encrypt($item->id)) }}" 
                        class="btn btn-primary w-100 mt-2">
                        Kunjungi Toko
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection