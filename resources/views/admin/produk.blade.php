@extends('admin.admtemp')
@section('admin')
<h3 class="mb-2">Data produk setiap toko</h3>
<table class="table table-hover">
    <thead class="table-info">
        <tr>
            <th>Nama produk</th>
            <th>kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Toko</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produk as $item)
        <tr>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->kategori->nama_kategori }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>{{ $item->stok }}</td>
            <td>{{ $item->toko->nama_toko }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection