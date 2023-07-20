@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Data Penerimaan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add-penerimaan"
                            class="btn btn-primary my-3">
                            <i class="bi bi-plus me-1"></i> Tambah Data Penerimaan
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
                        @error('penerima')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('pengirim')
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
                        <div class="modal fade" id="modal-add-penerimaan" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <form method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Data Penerimaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 mb-3">
                                                <label for="penerima" class="form-label">Penerima</label>
                                                <input type="text" class="form-control" id="penerima" name="penerima"
                                                    required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="pengirim" class="form-label">Pengirim</label>
                                                <input type="text" class="form-control" id="pengirim" name="pengirim"
                                                    required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="produk_masuk" class="form-label">Produk Masuk</label>
                                                <input type="number" class="form-control" id="produk_masuk"
                                                    name="produk_masuk" required>
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
                                    <th scope="col">Penerima</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Produk Masuk</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerimaans as $penerimaan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $penerimaan->tanggal }}</td>
                                        <td>{{ $penerimaan->penerima }}</td>
                                        <td>{{ $penerimaan->pengirim }}</td>
                                        <td>{{ $penerimaan->produk_masuk }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-penerimaan-{{ $penerimaan->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-penerimaan-{{ $penerimaan->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="modal-delete-penerimaan-{{ $penerimaan->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/data-penerimaan/{{ $penerimaan->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data Penerimaan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda yakin ingin menghapus penerimaan dengan penerima
                                                        {{ $penerimaan->penerima }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">tutup</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Modal Delete --}}

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="modal-edit-penerimaan-{{ $penerimaan->id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <form action="/data-penerimaan/{{ $penerimaan->id }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Data Penerimaan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mb-3">
                                                            <label for="tanggal" class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggal"
                                                                name="tanggal" value="{{ $penerimaan->tanggal }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="penerima" class="form-label">Penerima</label>
                                                            <input type="text" class="form-control" id="penerima"
                                                                name="penerima" value="{{ $penerimaan->penerima }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="pengirim" class="form-label">Pengirim</label>
                                                            <input type="text" class="form-control" id="pengirim"
                                                                name="pengirim" value="{{ $penerimaan->pengirim }}"
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="produk_masuk" class="form-label">Produk
                                                                Masuk</label>
                                                            <input type="number" class="form-control" id="produk_masuk"
                                                                name="produk_masuk"
                                                                value="{{ $penerimaan->produk_masuk }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
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
