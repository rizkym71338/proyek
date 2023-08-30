@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Penjualan Produk</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add-penjualan"
                            class="btn btn-primary my-3">
                            <i class="bi bi-plus me-1"></i> Tambah Data Penjualan
                        </button>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ session('error') }}
                            </div>
                        @endif
                        @error('no_kwitansi')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('pembeli')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('produk_keluar')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('satuan')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- Modal Add --}}
                        <div class="modal fade" id="modal-add-penjualan" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <form method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Penjualan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-primary alert-dismissible alert-info">
                                                Stok Produk Tersedia Saat Ini Adalah
                                                {{ $stok_produk }} Pack
                                            </div>
                                            <div class="col-12 mb-3 d-none">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                    value="{{ date('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="no_kwitansi" class="form-label">No Kwitansi</label>
                                                <input type="text" class="form-control" id="no_kwitansi"
                                                    name="no_kwitansi" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="pembeli" class="form-label">Pembeli</label>
                                                <input type="text" class="form-control" id="pembeli" name="pembeli"
                                                    required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="produk_keluar" class="form-label">Produk Keluar</label>
                                                <input type="number" class="form-control" id="produk_keluar"
                                                    name="produk_keluar" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="satuan" class="form-label">Satuan</label>
                                                <input type="text" class="form-control" id="satuan" name="satuan"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- Modal Add --}}

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No Kwitansi</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Produk Keluar</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                @foreach ($penjualans as $penjualan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ Carbon::parse($penjualan->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $penjualan->no_kwitansi }}</td>
                                        <td>{{ $penjualan->pembeli }}</td>
                                        <td>{{ $penjualan->produk_keluar }}</td>
                                        <td>{{ $penjualan->satuan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-penjualan-{{ $penjualan->id }}">
                                                <i class="bi bi-pencil-square"></i> Ubah
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-penjualan-{{ $penjualan->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="modal-delete-penjualan-{{ $penjualan->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/data-penjualan/{{ $penjualan->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data penjualan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda yakin ingin menghapus penjualan dengan pembeli
                                                        {{ $penjualan->pembeli }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Modal Delete --}}

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="modal-edit-penjualan-{{ $penjualan->id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <form action="/data-penjualan/{{ $penjualan->id }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Data Penjualan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mb-3">
                                                            <label for="tanggal" class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggal"
                                                                name="tanggal" value="{{ $penjualan->tanggal }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="no_kwitansi" class="form-label">No
                                                                Kwitansi</label>
                                                            <input type="text" class="form-control" id="no_kwitansi"
                                                                name="no_kwitansi" value="{{ $penjualan->no_kwitansi }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="pembeli" class="form-label">Pembeli</label>
                                                            <input type="text" class="form-control" id="pembeli"
                                                                name="pembeli" value="{{ $penjualan->pembeli }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="produk_keluar" class="form-label">Produk
                                                                Keluar</label>
                                                            <input type="number" class="form-control" id="produk_keluar"
                                                                name="produk_keluar"
                                                                value="{{ $penjualan->produk_keluar }}" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="satuan" class="form-label">Satuan</label>
                                                            <input type="text" class="form-control" id="satuan"
                                                                name="satuan" value="{{ $penjualan->satuan }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Modal Edit --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
