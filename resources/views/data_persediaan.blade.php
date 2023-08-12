@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Data Persediaan Produk</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add-persediaan"
                            class="btn btn-primary my-3">
                            <i class="bi bi-plus me-1"></i> Tambah Data Persediaan
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
                        @error('stok_produk')
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
                        @error('produk_masuk')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- Modal Add --}}
                        <div class="modal fade" id="modal-add-persediaan" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <form method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Persediaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 mb-3">
                                                <label for="produk_masuk" class="form-label">Produk Masuk</label>
                                                <input type="number" class="form-control" id="produk_masuk"
                                                    name="produk_masuk" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="produk_keluar" class="form-label">Produk Keluar</label>
                                                <input type="number" class="form-control" id="produk_keluar"
                                                    name="produk_keluar" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="stok_produk" class="form-label">Stok Produk</label>
                                                <input type="number" class="form-control" id="stok_produk"
                                                    name="stok_produk" required>
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
                                    <th scope="col">Produk Masuk</th>
                                    <th scope="col">Produk Keluar</th>
                                    <th scope="col">Stok Produk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($persediaans as $persediaan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $persediaan->tanggal }}</td>
                                        <td>{{ $persediaan->produk_masuk }}</td>
                                        <td>{{ $persediaan->produk_keluar }}</td>
                                        <td>{{ $persediaan->stok_produk }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-persediaan-{{ $persediaan->id }}">
                                                <i class="bi bi-pencil-square"></i> Ubah
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-persediaan-{{ $persediaan->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="modal-delete-persediaan-{{ $persediaan->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/data-persediaan/{{ $persediaan->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data Persediaan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda yakin ingin menghapus persediaan dengan stok produk
                                                        {{ $persediaan->stok_produk }} ?
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
                                    <div class="modal fade" id="modal-edit-persediaan-{{ $persediaan->id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <form action="/data-persediaan/{{ $persediaan->id }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Data Persediaan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mb-3">
                                                            <label for="tanggal" class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggal"
                                                                name="tanggal" value="{{ $persediaan->tanggal }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="produk_masuk" class="form-label">Produk
                                                                Masuk</label>
                                                            <input type="number" class="form-control" id="produk_masuk"
                                                                name="produk_masuk"
                                                                value="{{ $persediaan->produk_masuk }}" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="produk_keluar" class="form-label">Produk
                                                                Keluar</label>
                                                            <input type="number" class="form-control" id="produk_keluar"
                                                                name="produk_keluar"
                                                                value="{{ $persediaan->produk_keluar }}" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="stok_produk" class="form-label">Stok
                                                                Produk</label>
                                                            <input type="number" class="form-control" id="stok_produk"
                                                                name="stok_produk" value="{{ $persediaan->stok_produk }}"
                                                                required>
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
