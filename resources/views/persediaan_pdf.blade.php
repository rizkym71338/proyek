<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <br />
        <table style="width: 100%; border-bottom: solid black 2px">
            <tr>
                <th>
                    <img src="assets/img/desalogo.png"
                        style="
                                width: 150px;
                                height: 120px;
                                margin-bottom: 15px;
                            " />
                </th>
                <th style="text-align: center">
                    <span style="display: block; font-size: 20px">BADAN USAHA MILIK DESA</span>
                    <span style="display: block; font-size: 24px">" JAYA SAKTI "</span>
                    <span style="display: block; font-size: 20px">DESA GUMULUNG TONGGOH</span>
                    <span
                        style="
                                display: block;
                                font-size: 14px;
                                margin-bottom: 10px;
                            ">
                        Alamat : Jl. Cicariang RT.03 RW.04 Desa Gumulung Tonggoh Kec.
                        Greged Kab. Cirebon
                    </span>
                </th>
            </tr>
        </table>
        <br />
        <center>
            <h4>{{ $title }}</h4>
            @if ($start_date && $end_date)
                <h5>Periode {{ $start_date }} Sampai {{ $end_date }}</h5>
            @endif
        </center>
        <br />
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Produk Masuk</th>
                    <th scope="col">Produk Keluar</th>
                    <th scope="col">Stok Produk</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach ($persediaans as $persediaan)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ Carbon::parse($persediaan->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $persediaan->produk_masuk }}</td>
                        <td>{{ $persediaan->produk_keluar }}</td>
                        <td>{{ $persediaan->stok_produk }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
