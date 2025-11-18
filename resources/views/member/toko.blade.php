@extends('member.temp')
@section('toko')
@php
    $isKosong = $toko->nama_toko == '-' && 
                $toko->gambar == '-' && 
                $toko->alamat == '-';
@endphp
<div class="container my-5">
    @if ($isKosong)
        <h3 class="mb-3 text-center ">Anda belum membuka toko</h3>
    @else
        <h3 class="mb-3 text-center ">Kelola toko anda</h3>
    @endif
    <div class="mb-2 p-2 rounded border border-primary">
        <div class="row g-2">
            <div class="col-md-6">
                <div class="d-flex justify-content-between gap-2">
                    <div class="bg p-2 rounded border border-primary" style="width: 50%">
                        <h2 class="text-primary text-center"><i class="fa-solid fa-store"></i> : {{ $toko->nama_toko }}</h2>
                    </div>
                    <div class="bg p-2 rounded border border-primary" style="width: 50%">
                        <h2 class="text-primary text-center"><i class="fa-solid fa-basket-shopping"></i> Produk : {{ $produk->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between gap-2">
                    <div class="bg p-2 rounded bg bg-primary" style="width: 50%">
                        <h2 class="text-light text-center"><i class="fa-solid fa-user"></i> : {{ $toko->user->name }}</h2>
                    </div>
                    <div class="bg p-2 rounded bg bg-primary" style="width: 50%">
                        <h2 class="text-light text-center"><i class="fa-solid fa-phone"></i> : {{ $toko->nomor }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg bg-light rounded mt-2 border border-primary">
            <button type="button"
                    class="btn text-primary w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#tokoModal">
                {{ $isKosong ? 'Buka Toko' : 'Edit Toko' }}
            </button>
        </div>
        <div class="modal" id="tokoModal">
            <div class="modal-dialog custom-modal">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $isKosong ? 'Buka Toko' : 'Ubah Toko' }}
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('tokoUpdate', Crypt::encrypt(Auth::user()->toko->id)) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                {{-- Gambar hanya ditampilkan jika tidak '-' --}}
                                @if($toko->gambar != '-')
                                    <img src="{{ asset('storage/toko-img/'.$toko->gambar) }}" alt="" class="w-100 mb-2">
                                @endif
                                <label class="form-label">Gambar Toko</label>
                                <input type="file" name="gambar" class="form-control">
                                <label class="form-label mt-2">Nama Toko</label>
                                <input type="text" class="form-control" name="nama_toko" value="{{ $toko->nama_toko }}">
                                <label class="form-label mt-2">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $toko->alamat }}">
                                <label class="form-label mt-2">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3">{{ $toko->deskripsi }}</textarea>
                            </div>
                            <!-- Footer -->
                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ $isKosong ? 'Simpan Toko' : 'Simpan Perubahan' }}
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($isKosong)
            <div class="bg bg-primary text-white rounded mt-2 p-5 text-center">
                <h3 class="my-5">Buka Toko untuk menambahkan produk</h3>
            </div>
        @else
            <div class="bg bg-primary text-white rounded mt-2 p-2">
                <div class="d-flex justify-content-between row">
                    <h3 class="text-white col-md-6">Produk</h3>
                    <div class="d-flex gap-3 col-md-6 justify-content-end">
                        <form class="d-flex" id="search">
                            <input class="form-control me-2" type="text" placeholder="cari....">
                            <button class="btn btn-success" type="button">Cari</button>
                        </form>
                        <button class="btn btn-light border border-success text-success" data-bs-toggle="modal" data-bs-target="#modalProduk">Tambah Produk</button>
                    </div>
                </div>
                <div class="" style="overflow-y: auto; height: 360px;">
                    <table class="table table-hover mt-2">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-2">Nama Produk</th>
                                <th class="col-2">Kategori</th>
                                <th class="col-2">Harga</th>
                                <th class="col-2">Stok</th>
                                <th class="col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <form action="{{ route('produk.updateStock', Crypt::encrypt($item->id)) }}" method="post" class="d-flex">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="stok" value="{{ $item->stok }}" class="form-control w-25">
                                        <input type="submit" value="Ubah stok" class="btn btn-primary btn-sm ms-2">
                                    </form>
                                </td>
                                {{-- <td>{{ $item->stok }}</td> --}}
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="modal" id="modalProduk">
            <div class="modal-dialog custom-modal">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Tambah Produk
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="{{ route('ProdukStore') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label mt-2">Nama produk</label>
                                <input type="text" class="form-control" name="nama_produk">
                                <label class="form-label mt-2">Harga</label>
                                <input type="text" class="form-control" name="harga">
                                <label class="form-label mt-2">Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="" class="text-center">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" class="text-center">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label mt-2">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                            <!-- Footer -->
                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Tambah Produk
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded shadow mb-2">
        <a href="{{ route('home') }}" class="btn w-100 border-primary text-primary">Kembali</a>
    </div>
    <div class="rounded shadow">
        <a href="{{ url('/logout') }}" class="btn btn-danger w-100">Keluar</a>
    </div>
</div>
@endsection