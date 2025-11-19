@extends('admin.admtemp')
@section('admin')
    <div class="d-flex justify-content-between row">
        <h3 class="col-md-6 mb-2">Kategori</h3>
        <div class="col-md-6 d-flex gap-4 justify-content-end">
            <form class="d-flex" id="search">
                <input class="form-control me-2" type="text" placeholder="cari....">
                <button class="btn btn-success" type="button">Cari</button>
            </form>
            <a href="#" class="btn btn-light border-primary text-primary" data-bs-toggle="modal" data-bs-target="#KategoriModal">Tambah kategori</a>
        </div>
    </div>
    <div class="modal fade" id="KategoriModal">
        <div class="modal-dialog custom-modal">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Kategori
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('katStore') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label class="form-label mt-2">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori">
                        </div>
                        <!-- Footer -->
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">
                                Tambah Kategori
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
    <div class="py-2">
        <div class="table-responsive">
            <table class="table table-hover bg-white">
                <thead class="table-info">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>
                            <button 
                                class="btn btn-warning btn-sm"
                                data-id="{{ $item->id }}"
                            >Edit</button>
                            <button 
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusKategori{{ $item->id }}">
                                Hapus
                            </button>
                        </td>
                        <div class="modal fade" id="modalHapusKategori{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus kategori:</p>
                                        <p class="fw-bold">{{ $item->nama_kategori }}</p>
                                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form 
                                            action="{{ route('KategoriDestroy', $item->id) }}" 
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                </tbody>
            </table>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1">
            <div class="modal-dialog custom-modal">
                <div class="modal-content">
                <form id="formEdit" method="POST">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label mt-2">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">
                                Edit Kategori
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection