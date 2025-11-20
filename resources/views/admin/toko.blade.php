@extends('admin.admtemp')
@section('admin')
<div class="d-flex justify-content-between row">
    <h3 class="col-md-6 mb-2">Toko</h3>
    <div class="col-md-6 d-flex gap-4 justify-content-end">
        <form class="d-flex" id="search">
            <input class="form-control me-2" type="text" placeholder="cari....">
            <button class="btn btn-success" type="button">Cari</button>
        </form>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive mt-2">
    <table class="table table-hover table-striped">
        <thead class="table-info">
            <tr>
                <th>No</th>
                <th>Nama Toko</th>
                <th>Nama Pemilik</th>
                <th>Nomor</th>
                <th>Jumlah Produk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tokos as $toko)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $toko->nama_toko }}</td>
                <td>{{ $toko->user->name }}</td>
                <td>{{ $toko->nomor }}</td>
                <td>{{ $toko->produk->count() }} Produk</td>
                <td>
                    @if($toko->status == 'aktif')
                        <span class="badge bg-success">Toko aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('TokoStatus', $toko->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-sm"
                                onclick="return confirm('Yakin ingin mengubah status toko ini?')">
                            {{ $toko->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection