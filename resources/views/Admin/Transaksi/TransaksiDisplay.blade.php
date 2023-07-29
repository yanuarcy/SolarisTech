@extends('Admin.Sidebar')

@section('contentdashboard')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $Tittle }}</h4>
            </div>
        </div>
        <hr>
        <div class="table-responsive border p-3 rounded-3">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="TransaksiTable">
                <thead>
                    <tr>
                        <th style="width: 1%">No. </th>
                        <th style="width: 1%">Order ID</th>
                        <th class="text-center">Kode Pemesanan</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nama Member</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Alamat Pengiriman</th>
                        <th class="text-center">Jumlah Transaksi</th>
                        <th class="text-center">Metode Pembayaran</th>
                        <th class="text-center">Status Bayar</th>
                        <th class="text-center">Bukti Bayar</th>
                        <th class="text-center">Tanggal Order</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $No = 1;
                    @endphp
                    @foreach ($Transaksis->reverse() as $Transaksi)
                        <tr>
                            <td>{{ $No }}</td>
                            <td>{{ $Transaksi->order_id }}</td>
                            <td>{{ $Transaksi->kode_pemesanan }}</td>
                            <td>{{ $Transaksi->email }}</td>
                            <td>{{ $Transaksi->nm_member }}</td>
                            <td>{{ $Transaksi->telephone }}</td>
                            <td>{{ $Transaksi->alamat_pengiriman }}</td>
                            <td>{{ $Transaksi->jml_transaksi }}</td>
                            <td>{{ $Transaksi->metode_pembayaran }}</td>
                            <td>{{ $Transaksi->status_bayar }}</td>
                            {{-- <td>{{ $Transaksi->photo }}</td> --}}
                            <td>
                                @if ($Transaksi->photo)
                                    <img src="{{ Vite::asset('resources/images/BuktiBayar/' . $Transaksi->photo) }}" alt="{{ $Transaksi->nm_produk }}" width="100">
                                @else
                                    Gambar tidak tersedia
                                @endif
                            </td>
                            <td class="text-center">{{ $Transaksi->created_at ? \Carbon\Carbon::parse($Transaksi->created_at)->format('Y-m-d') : '-' }}</td>
                            <td>@include('Layouts.actions')</td>
                        </tr>
                        @php
                            $No++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#TransaksiTable').DataTable();

            $(".datatable").on("click", ".btn-delete", function (e) {
                e.preventDefault();

                var form = $(this).closest("form");
                var name = $(this).data("name");

                Swal.fire({
                    title: "Are you sure want to delete\n" + name + "?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endpush
