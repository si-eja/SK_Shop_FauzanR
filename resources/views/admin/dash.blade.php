@extends('admin.admtemp')
@section('admin')
<div class="row g-2 text-white">
    <div class="col-md-6 d-flex gap-2">
        <div class="rounded bg bg-primary p-3 w-50">
            <h3>Pengguna : {{ $user->count() }}</h3>
        </div>
        <div class="rounded bg bg-primary p-3 w-50">
            <h3>Toko : {{ $toko->count() }}</h3>
        </div>
    </div>
    <div class="col-md-6 d-flex gap-2">
        <div class="rounded bg bg-primary p-3 w-50">
            <h3>Produk : {{ $produk->count() }}</h3>
        </div>
        <div class="rounded bg bg-primary p-3 w-50">
            <h3>Kategori : {{ $kategori->count() }}</h3>
        </div>
    </div>
</div>
<hr>
<div class="text-center">
    <h2>Data Pengguna</h2>
    <table class="table table-hover">
        <thead class="table-info">
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->toko->nomor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection