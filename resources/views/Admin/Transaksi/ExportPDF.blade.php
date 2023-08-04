@extends('Template.template')

@section('Content')
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
    <h1>Employee List</h1>
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
            @foreach ($Transaksi as $index => $transaksi)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $transaksi->order_id }}</td>
                    <td>{{ $transaksi->kode_pemesanan }}</td>
                    <td>{{ $transaksi->email }}</td>
                    <td align="center">{{ $transaksi->nm_member }}</td>
                    <td>{{ $transaksi->telephone }}</td>
                    <td>{{ $transaksi->alamat_pengiriman }}</td>
                    <td>{{ $transaksi->jml_transaksi }}</td>
                    <td>{{ $transaksi->metode_pembayaran }}</td>
                    <td>{{ $transaksi->status_bayar }}</td>
                    <td>{{ $transaksi->photo }}</td>
                    <td>{{ $transaksi->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
