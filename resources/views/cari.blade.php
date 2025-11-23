@extends('template')
@section('content')
<div class="container py-4">
    <h2>Hasil pencarian: "{{ $key }}"</h2>

    <hr>

    @if ($produk->count() == 0)
        <div class="alert alert-warning">
            Tidak ada produk yang cocok dengan pencarian.
        </div>
    @endif

    <div class="row g-3">
        @foreach ($produk as $item)
        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm h-100">

                @if ($item->gambar->first())
                    <img src="{{ asset('storage/img-prod/' . $item->gambar->first()->nama_gambar) }}"
                        class="card-img-top"
                        style="height: 180px; object-fit: cover;">
                @else
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded-top"
                     style="height:180px;">
                     <span>Tidak ada gambar</span>
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                    <p class="card-text mb-1">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>
                    <div class="d-flex gap-2">
                        <p>Stok: {{ $item->stok }}</p>
                        <p class="badge bg-secondary">{{ $item->kategori->nama_kategori }}</p>
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-2 mt-2">
                        <a href="{{ route('produk.wa', $item->id) }}" class="btn btn-success w-100">
                            Pesan via Whatsapp
                        </a>
                        <a href="{{ route('ProdukD', Crypt::encrypt($item->id)) }}"
                           class="btn btn-light border border-primary text-primary">
                            Detail
                        </a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection