@extends('member.temp')
@section('toko')
@php
    $isKosong = $toko->nama_toko == '-' && 
                $toko->gambar == '-' && 
                $toko->alamat == '-';
@endphp
@if ($isNonaktif)
    <div class="alert alert-danger text-center fw-bold">
        Minta persetujuan <u>Admin</u> jika ingin membuka toko.
        <br>Tunggu beberapa saat...
        <div class="d-flex justify-content-end">
            <a href="{{ route('tokoAcc', $toko->id) }}" class="btn btn-light border border-success text-success">kontak admin</a>
        </div>
    </div>
@endif
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
                <div class="d-flex bg bg-primary justify-content-start rounded p-2">
                    <div class="d-flex gap-3 d-flex align-items-center mx-5">
                        <h6 class="text-light text-center"><i class="fa-solid fa-user"></i> : {{ $toko->user->name }}</h6>
                        <h6 class="text-light text-center"><i class="fa-solid fa-phone"></i> : {{ $toko->nomor }}</h6>
                    </div>
                    <button class="btn btn-light text-primary w-25 my-1" data-bs-toggle="collapse" data-bs-target="#ubahNomor">Ubah</button>
                </div>
            </div>
        </div>
        <div id="ubahNomor" class="collapse">
            <form action="{{ route('nomorUpdate', Crypt::encrypt(Auth::user()->toko->id)) }}" method="post">
            @csrf
                <div class="input-group mt-2">
                    <input type="text" class="form-control" name="nomor" placeholder="Masukkan nomor baru" value="{{ $toko->nomor }}">
                    <button type="submit" class="btn btn-primary">Simpan Nomor</button>
                </div>
            </form>
        </div>
        <div class="fw-bold">
            <h4>Deskripsi</h4>
            <h6>{{ $toko->deskripsi }}</h6>
        </div>
        <div class="bg bg-light rounded mt-2 border border-primary">
            <button type="button"
                class="btn text-primary w-100"
                {{ $isNonaktif ? 'disabled' : '' }}
                data-bs-toggle="{{ $isNonaktif ? '' : 'modal' }}"
                data-bs-target="{{ $isNonaktif ? '' : '#tokoModal' }}">
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
                        <form class="d-flex" method="GET" action="">
                            <input class="form-control me-2" type="text" name="keyword"
                                placeholder="cari...." value="{{ request('keyword') }}">
                            <button class="btn btn-success" type="submit">Cari</button>
                        </form>
                        <button class="btn btn-light border border-success text-success"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalProduk"
                            {{ $isNonaktif ? 'disabled' : '' }}>
                            Tambah Produk
                        </button>
                    </div>
                </div>
                <div class="table-responsive" style="height: 360px; overflow-y: auto;">
                    <div class="table-wrapper">
                        <table class="table table-hover mt-2 align-middle">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-2">Nama Produk</th>
                                    <th class="col-1">Kategori</th>
                                    <th class="col-1">Harga</th>
                                    <th class="col-2">Stok</th>
                                    <th class="col-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($produk->count() == 0)
                                    <tr>
                                        <td colspan="6" class="text-center text-danger fw-bold">
                                            Data tidak tersedia
                                        </td>
                                    </tr>
                                @else
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
                                                <input type="text" name="stok" value="{{ $item->stok }}" class="form-control" {{ $isNonaktif ? 'disabled' : '' }}>
                                                <input type="submit" value="Ubah stok" class="btn btn-primary btn-sm ms-2" {{ $isNonaktif ? 'disabled' : '' }}>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetailProduk{{ $item->id }}">
                                                Detail
                                            </button>
                                            <button class="btn btn-warning btn-sm"
                                                {{ $isNonaktif ? 'disabled' : '' }}
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                {{ $isNonaktif ? 'disabled' : '' }}
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalHapus{{ $item->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title text-dark">
                                                        Edit Produk: {{ $item->nama_produk }}
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('ProdukUpdate', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        {{-- Nama Produk --}}
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Produk</label>
                                                            <input type="text" class="form-control" name="nama_produk"
                                                                value="{{ $item->nama_produk }}">
                                                        </div>
                                                        {{-- Harga --}}
                                                        <div class="mb-3">
                                                            <label class="form-label">Harga</label>
                                                            <input type="number" class="form-control" name="harga"
                                                                value="{{ $item->harga }}">
                                                        </div>
                                                        {{-- Kategori --}}
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="kategori_id" class="form-control">
                                                                @foreach ($kategori as $kat)
                                                                    <option value="{{ $kat->id }}"
                                                                        {{ $kat->id == $item->kategori_id ? 'selected' : '' }}>
                                                                        {{ $kat->nama_kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- Deskripsi --}}
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
                                                        </div>
                                                        {{-- Input Gambar Baru --}}
                                                        <div class="mb-3">
                                                            <label class="form-label">Tambah Gambar (Maksimal 5)</label>
                                                            <input type="file" name="gambar_produk[]" class="form-control" multiple>
                                                        </div>
                                                        {{-- Gambar Lama --}}
                                                        <div class="mb-2">
                                                            <label class="form-label">Gambar Lama</label>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2 mb-4 old-images">
                                                            @foreach ($item->gambar as $gmbr)
                                                                <img src="{{ asset('storage/img-prod/' . $gmbr->nama_gambar) }}" alt="Gambar Produk">
                                                            @endforeach
                                                            @if (count($item->gambar) == 0)
                                                                <p class="text-muted">Tidak ada gambar</p>
                                                            @endif
                                                        </div>
                                                        {{-- Footer --}}
                                                        <div class="d-flex justify-content-between mt-4">
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Detail Produk -->
                                    <div class="modal fade" id="modalDetailProduk{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Detail Produk: {{ $item->nama_produk }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Data Produk -->
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Kategori:</label>
                                                        <p class="text-black">{{ $item->kategori->nama_kategori }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Harga:</label>
                                                        <p class="text-black">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Stok:</label>
                                                        <p class="text-black">{{ $item->stok }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Deskripsi:</label>
                                                        <p class="text-black">{{ $item->deskripsi ?? '-' }}</p>
                                                    </div>
                                                    <hr>
                                                    <!-- Gambar Produk -->
                                                    <label class="fw-bold d-block mb-2">Gambar Produk:</label>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @if(count($item->gambar) > 0)
                                                            @foreach ($item->gambar as $g)
                                                                <img src="{{ asset('storage/img-prod/'.$g->nama_gambar) }}"
                                                                    style="width:150px; height:150px; object-fit:cover; border-radius:10px;"
                                                                    class="border">
                                                            @endforeach
                                                        @else
                                                            <p class="text-muted">Tidak ada gambar</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Konfirmasi Hapus Produk</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda yakin ingin menghapus produk <strong>{{ $item->nama_produk }}</strong>?</p>
                                                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('ProdukDestroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus produk ini secara permanen?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <div class="modal fade" id="modalProduk">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning">
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
                                @error('nama_produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label class="form-label mt-2">Harga</label>
                                <input type="text" class="form-control" name="harga">
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label class="form-label mt-2">Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="" class="text-center">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" class="text-center">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label class="form-label mt-2">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                @error('deskripsi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="d-flex">
                                    <div class="d-flex justify-content-start align-content-start">
                                        <label class="form-label mt-2">Gambar Produk</label>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap" id="preview-container">
                                        @for ($i = 0; $i < 5; $i++)
                                        <div class="preview-box rounded bg-info d-flex align-items-center justify-content-center text-white fw-bold img-fit img-wrapper"
                                            style="height: 120px; width: 120px;">
                                            <span>+</span>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <input type="file" name="gambar_produk[]" class="form-control mt-2" id="gambar_produk" multiple accept="image/*">
                                @error('gambar_produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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