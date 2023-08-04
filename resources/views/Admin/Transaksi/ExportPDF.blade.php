<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laporan Penjualan - SolarisTech</title>
        <style>
            html {
                font-size: 12px;
            }

            .table {
                border-collapse: collapse !important;
                width: 100%;
            }

            .table-bordered th,
            .table-bordered td {
                padding: 0.5rem;
                border: 1px solid black !important;
            }
        </style>
    </head>
    <body>
        <h1 align="center">Laporan Penjualan SolarisTech</h1>
        <hr style="margin-bottom: 2%;">
        <h2>Laporan di cetak pada : {{ $currentTime }}</h2>
        <hr style="margin-bottom: 5%; margin-top: 2%;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Order ID</th>
                    <th>Kode Pemesanan</th>
                    <th>Email</th>
                    <th>Nama Member</th>
                    <th>Telephone</th>
                    <th>Alamat Pengiriman</th>
                    <th>Jumlah Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Bayar</th>
                    <th>Bukti Bayar</th>
                    <th>Tanggal Order</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $TotalPenjualan = 0;
                    $BelumBayar = 0;
                    $MenungguKonfirmasi = 0;
                    $Sukses = 0;
                @endphp
                @foreach ($Transaksi as $index => $transaksi)
                    <tr>
                        <td align="center">{{ $index + 1 }}</td>
                        <td align="center">{{ $transaksi->order_id }}</td>
                        <td>{{ $transaksi->kode_pemesanan }}</td>
                        <td>{{ $transaksi->email }}</td>
                        <td align="center">{{ $transaksi->nm_member }}</td>
                        <td>{{ $transaksi->telephone }}</td>
                        <td>{{ $transaksi->alamat_pengiriman }}</td>
                        <td>Rp {{ number_format($transaksi->jml_transaksi, 0, ',', '.') }}</td>
                        <td align="center">{{ $transaksi->metode_pembayaran }}</td>
                        <td align="center">{{ $transaksi->status_bayar }}</td>
                        <td>{{ $transaksi->photo }}</td>
                        <td>{{ $transaksi->created_at }}</td>
                    </tr>
                    @php
                        if($transaksi->status_bayar == 'Sukses' || $transaksi->status_bayar == 'sukses') {
                            $TotalPenjualan += $transaksi->jml_transaksi;
                            $Sukses ++;
                        }
                        elseif ($transaksi->status_bayar == 'Menunggu Konfirmasi') {
                            $MenungguKonfirmasi ++;
                        }
                        elseif ($transaksi->status_bayar == 'belum bayar') {
                            $BelumBayar ++;
                        }
                    @endphp
                @endforeach
            </tbody>
        </table>
        <h3>Total Status Bayar</h3>
        <h4>Belum Bayar : {{ $BelumBayar }} </h4>
        <h4>Menunggu Konfirmasi : {{ $MenungguKonfirmasi }} </h4>
        <h4>Sukses : {{ $Sukses }}</h4>
        <h2>Total Penjualan : Rp {{ number_format($TotalPenjualan, 0, ',', '.') }}</h2>
        <h4 style="color: red;">*Total Penjualan di hitung ketika status bayar customer sukses</h4>

    </body>
</html>
