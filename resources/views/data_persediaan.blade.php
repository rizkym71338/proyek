@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Data Persediaan Produk</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Stok Telur</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-database"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $stok_produk }} Pack</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <br>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Produk Masuk</th>
                                    <th scope="col">Produk Keluar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                @foreach ($persediaans as $persediaan)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ Carbon::parse($persediaan->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $persediaan->produk_masuk }}</td>
                                        <td>{{ $persediaan->produk_keluar }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-detail-produk-masuk-{{ $persediaan->id }}">
                                                <i class="bi bi-eye"></i> Lihat
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Detail Produk Masuk --}}
                                    <div class="modal fade" id="modal-detail-produk-masuk-{{ $persediaan->id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Persediaan Pada Tanggal
                                                        {{ Carbon::parse($persediaan->tanggal)->format('d-m-Y') }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="h4">Catatan Produk Masuk</div>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <div
                                                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                            <div style="flex: 1; padding: 0 8px;">Penerima</div>
                                                            <div style="flex: 1; padding: 0 8px;">Pengirim</div>
                                                            <div style="flex: 1; padding: 0 8px;">Produk Masuk</div>
                                                            <div style="flex: 1; padding: 0 8px;">satuan</div>
                                                        </div>
                                                        @php
                                                            $total_masuk = 0;
                                                        @endphp
                                                        @foreach ($penerimaans as $penerimaan)
                                                            @if ($penerimaan->tanggal == $persediaan->tanggal)
                                                                @php
                                                                    $total_masuk += $penerimaan->produk_masuk;
                                                                @endphp
                                                                <div
                                                                    style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penerimaan->penerima }}
                                                                    </div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penerimaan->pengirim }}
                                                                    </div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penerimaan->produk_masuk }}
                                                                    </div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penerimaan->satuan }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <div
                                                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                Total
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                {{ $total_masuk }}
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                Pack
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="h4">Catatan Produk Keluar</div>
                                                    <div style="display: flex; flex-direction: column;">
                                                        <div
                                                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                            <div style="flex: 1; padding: 0 8px;">No Kwitansi</div>
                                                            <div style="flex: 1; padding: 0 8px;">Pembeli</div>
                                                            <div style="flex: 1; padding: 0 8px;">Produk Keluar</div>
                                                            <div style="flex: 1; padding: 0 8px;">satuan</div>
                                                        </div>
                                                        @php
                                                            $total_keluar = 0;
                                                        @endphp
                                                        @foreach ($penjualans as $penjualan)
                                                            @if ($penjualan->tanggal == $persediaan->tanggal)
                                                                @php
                                                                    $total_keluar += $penjualan->produk_keluar;
                                                                @endphp
                                                                <div
                                                                    style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penjualan->no_kwitansi }}</div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penjualan->pembeli }}</div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penjualan->produk_keluar }}</div>
                                                                    <div style="flex: 1; padding: 0 8px;">
                                                                        {{ $penjualan->satuan }}</div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <div
                                                            style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                Total
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                {{ $total_keluar }}
                                                            </div>
                                                            <div style="flex: 1; padding: 0 8px;">
                                                                Pack
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal Detail Produk Masuk --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
