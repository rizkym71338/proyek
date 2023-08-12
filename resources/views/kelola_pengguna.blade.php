@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Kelola Pengguna</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add-user"
                            class="btn btn-primary my-3">
                            <i class="bi bi-plus me-1"></i> Tambah Pengguna
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
                        @error('username')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('role')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        @error('password')
                            <div class="alert alert-danger alert-dismissible alert-info">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- Modal Add --}}
                        <div class="modal fade" id="modal-add-user" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <form method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-select" aria-label="role" name="role">
                                                    <option value="Divisi Peternakan">Divisi Peternakan</option>
                                                    <option value="Penerimaan">Penerimaan</option>
                                                    <option value="Penjualan">Penjualan</option>
                                                    <option value="Persediaan">Persediaan</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-user-{{ $user->id }}">
                                                <i class="bi bi-pencil-square"></i> Ubah
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-user-{{ $user->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Modal Delete --}}
                                    <div class="modal fade" id="modal-delete-user-{{ $user->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/kelola-pengguna/{{ $user->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Pengguna</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda yakin ingin menghapus pengguna dengan Username
                                                        {{ $user->username }} ?
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
                                    <div class="modal fade" id="modal-edit-user-{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <form action="/kelola-pengguna/{{ $user->id }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Pengguna</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" value="{{ $user->username }}">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="role" class="form-label">Role</label>
                                                            <select class="form-select" aria-label="role" name="role">
                                                                <option value="Divisi Peternakan"
                                                                    {{ $user->role == 'Divisi Peternakan' ? 'selected' : '' }}>
                                                                    Divisi Peternakan
                                                                </option>
                                                                <option value="Penerimaan"
                                                                    {{ $user->role == 'Penerimaan' ? 'selected' : '' }}>
                                                                    Penerimaan
                                                                </option>
                                                                <option value="Penjualan"
                                                                    {{ $user->role == 'Penjualan' ? 'selected' : '' }}>
                                                                    Penjualan
                                                                </option>
                                                                <option value="Persediaan"
                                                                    {{ $user->role == 'Persediaan' ? 'selected' : '' }}>
                                                                    Persediaan
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password">
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
