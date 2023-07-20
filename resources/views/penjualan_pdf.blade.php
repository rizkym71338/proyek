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
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No Kwitansi</th>
                    <th>Pembeli</th>
                    <th>Produk Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualans as $penjualan)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $penjualan->tanggal }}</td>
                        <td>{{ $penjualan->no_kwitansi }}</td>
                        <td>{{ $penjualan->pembeli }}</td>
                        <td>{{ $penjualan->produk_keluar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
