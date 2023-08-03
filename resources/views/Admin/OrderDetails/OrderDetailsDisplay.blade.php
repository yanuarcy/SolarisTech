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
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="DetailOrder">
                <thead>
                    <tr>
                        {{-- <th align="center">ID</th> --}}
                        <th style="width: 1%">No. </th>
                        <th class="text-center">Tanggal Order</th>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Nama Member</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Jumlah Barang</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $No = 1;
                    @endphp
                    @foreach ($OrderDetails as $detailOrder)
                        <tr>
                            <td>{{ $No }}</td>
                            <td class="text-center">{{ $detailOrder->created_at ? \Carbon\Carbon::parse($detailOrder->created_at)->format('Y-m-d') : '-' }}</td>
                            <td>{{ $detailOrder->order_id }}</td>
                            <td>{{ $detailOrder->nm_member }}</td>
                            <td>{{ $detailOrder->nm_barang }}</td>
                            <td>{{ $detailOrder->jml_barang }}</td>
                            <td>{{ $detailOrder->total_harga }}</td>
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
            $('#DetailOrder').DataTable();

        });
    </script>
@endpush
