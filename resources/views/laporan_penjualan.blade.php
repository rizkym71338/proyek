@extends('layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Laporan Penjualan Produk</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" class="row my-1">
                            <div class="col-3">
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ $start_date }}" required>
                            </div>
                            <div class="col-3">
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ $end_date }}" required>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filter
                                </button>
                            </div>
                            <div class="col-3">
                                <a href="/laporan-penjualan/cetak-pdf?start_date={{ $start_date }}&end_date={{ $end_date }}"
                                    type="submit" class="btn btn-primary">
                                    <i class="bi bi-filetype-pdf me-1"></i>
                                    Unduh PDF
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No Kwitansi</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Produk Keluar</th>
                                    <th scope="col">Satuan</th>
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
