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
                        <button type="button" class="btn btn-primary my-3">
                            Stok Telur {{ $stok_produk }} Pack
                        </button>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Produk Masuk</th>
                                    <th scope="col">Produk Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($persediaans as $persediaan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $persediaan->tanggal }}</td>
                                        <td>{{ $persediaan->produk_masuk }}</td>
                                        <td>{{ $persediaan->produk_keluar }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
