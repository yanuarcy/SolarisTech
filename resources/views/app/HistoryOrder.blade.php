@extends('Template.template')

@vite('resources/sass/app/HistoryOrder.scss')
@section('Content')
    <div class="container-sm my-5">
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 col-xl-4 border w-100">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>History Order</h4>
                </div>
                <hr>
                <div class="row">
                    @foreach ($groupedTransaksis as $date => $transaksis)
                        <h2>{{ $date }}</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th class="kodePemesanan">Kode Pemesanan</th>
                                    <th>Nama</th>
                                    <th>Telephone</th>
                                    <th>Alamat Pengiriman</th>
                                    <th class="jmlTransaksi">Jumlah Transaksi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status Bayar</th>
                                    <th>Bukti Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomer = 1;
                                @endphp
                                @foreach ($transaksis as $Transaksi)
                                    <tr style="margin-bottom: 50px">
                                        <td>{{ $nomer }}</td>
                                        <td class="kodePemesanan">
                                            <span class="kode-pemesanan">{{ $Transaksi->kode_pemesanan }}</span>
                                            <button class="btn btn-outline-primary btn-salin" data-clipboard-text="{{ $Transaksi->kode_pemesanan }}">
                                                <i class="far fa-copy"></i>
                                            </button>
                                        </td>
                                        <td>{{ $Transaksi->nm_member }}</td>
                                        <td>{{ $Transaksi->telephone }}</td>
                                        <td>{{ $Transaksi->alamat_pengiriman }}</td>
                                        <td class="jmlTransaksi">{{ $Transaksi->jml_transaksi }}</td>
                                        <td>{{ $Transaksi->metode_pembayaran }}</td>
                                        <td>{{ $Transaksi->status_bayar }}</td>
                                        <td>
                                            @if ($Transaksi->status_bayar === 'sukses')
                                                {{ $Transaksi->photo }}
                                            @elseif ($Transaksi->status_bayar === 'belum bayar')
                                                <a href="{{ route('Pay', ['id' => $Transaksi->id]) }}" class="btn btn-primary">Pay</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $nomer++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('CustProfile') }}" class="btn btn-outline-dark btn-lg w-100 mt-3"><i class="bi-arrow-left-circle me-2"></i> Biodata</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Clipboard.js untuk semua tombol dengan kelas .btn-salin
            new ClipboardJS('.btn-salin');

            // Tambahkan event click untuk memberikan feedback bahwa teks berhasil disalin
            var tombolSalin = document.querySelectorAll('.btn-salin');

            tombolSalin.forEach(function (tombol) {
                tombol.addEventListener('click', function () {
                    tombol.querySelector('i').classList.remove('far', 'fa-copy'); // Menghapus kelas 'far' untuk mengaktifkan ikon salin yang sudah disalin
                    tombol.querySelector('i').classList.add('fas', 'fa-check'); // Menambahkan kelas 'fas' untuk mengaktifkan ikon salin yang sudah disalin

                    setTimeout(function () {
                        tombol.querySelector('i').classList.remove('fas', 'fa-check'); // Menghapus kelas 'fas' setelah 1,5 detik untuk mengembalikan ikon menjadi tidak tercentang
                        tombol.querySelector('i').classList.add('far', 'fa-copy'); // Menambahkan kelas 'far' untuk mengembalikan ikon menjadi tidak tercentang

                    }, 1500); // Kembalikan ikon setelah 1,5 detik
                });
            });
        });
    </script>
@endpush
