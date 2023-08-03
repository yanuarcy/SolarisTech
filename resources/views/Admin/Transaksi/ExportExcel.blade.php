<table>
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
        @foreach ($Transaksis as $index => $Transaksi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $Transaksi->order_id }}</td>
                <td>{{ $Transaksi->kode_pemesanan }}</td>
                <td>{{ $Transaksi->email }}</td>
                <td>{{ $Transaksi->nm_member }}</td>
                <td>{{ $Transaksi->telephone }}</td>
                <td>{{ $Transaksi->alamat_pengiriman }}</td>
                <td>{{ $Transaksi->jml_transaksi }}</td>
                <td>{{ $Transaksi->metode_pembayaran }}</td>
                <td>{{ $Transaksi->status_bayar }}</td>
                <td>{{ $Transaksi->photo }}</td>
                <td>{{ $Transaksi->created_at ? \Carbon\Carbon::parse($Transaksi->created_at)->format('Y-m-d') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
