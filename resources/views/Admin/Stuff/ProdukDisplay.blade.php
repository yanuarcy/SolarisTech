@extends('Admin.Sidebar')

@section('contentdashboard')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $Tittle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="{{ route('Product.create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive border p-3 rounded-3" style="background-color: #191C24; color: white;">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="ProductTable">
                <thead>
                    <tr>
                        <th align="center">ID</th>
                        <th>No. </th>
                        <th>Kategori</th>
                        <th>Member</th>
                        <th style="width: 15%">Nama Produk</th>
                        <th style="width: 15%">Harga Produk</th>
                        <th>Stok</th>
                        <th>Deskripsi Produk</th>
                        <th>Foto Produk</th>
                        <th>Actions</th>
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
            $("#ProductTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getProduct",
                columns: [

                    { data: "id", name: "id", visible: false },
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "kategori.nm_kategori", name: "kategori.nm_kategori"},
                    { data: "user.name", name: "user.name"},
                    { data: "nm_produk", name: "nm_produk" },
                    { data: "hg_produk", name: "hg_produk" },
                    { data: "stok", name: "stok" },
                    { data: "desc_produk", name: "desc_produk" },
                    {
                        data: "photo",
                        name: "photo",
                        render: function (data, type, row) {
                            if (data) {
                                return '<img src="' + "{{ Vite::asset('resources/images/') }}" + data + '" alt="' + row.nm_produk + '" width="100">';
                            } else {
                                return 'Gambar tidak tersedia';
                            }
                        },
                    },
                    { data: "actions", name: "actions", orderable: false, searchable: false },
                ],
                order: [[0, "desc"]],
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"],
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
