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
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="OrderTable">
                <thead>
                    <tr>
                        <th align="center">ID</th>
                        <th style="width: 1%">No. </th>
                        <th class="text-center">Tanggal Order</th>
                        <th class="text-center">Nama Member</th>
                        <th class="text-center">Total Order</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->kategori->nm_kategori }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>{{ $product->nm_produk }}</td>
                            <td>{{ $product->hg_produk }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>{{ $product->desc_produk }}</td>
                            <td>
                                @if ($product->photo)
                                    <img src="{{ Vite::asset('resources/images/' . $product->photo) }}" alt="{{ $product->nm_produk }}" width="100">
                                @else
                                    Gambar tidak tersedia
                                @endif
                            </td>
                            <td>@include('Layouts.actions')</td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#OrderTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getOrder",
                columns: [

                    { data: "id", name: "id", visible: false },
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "created_at", name: "created_at"},
                    { data: "user.name", name: "user.name"},
                    { data: "total_harga", name: "total_harga"},
                    { data: "actions", name: "actions", orderable: false, searchable: false }
                ],
                order: [[0, "desc"]],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
            });

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
