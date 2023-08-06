@extends('Admin.Sidebar')

@section('contentdashboard')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $Tittle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="{{ route('Kategori.create') }}" class="btn btn-primary">Add Category</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive border p-3 rounded-3" style="background-color: #34465A; color: white;">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="KategoriTable">
                <thead>
                    <tr>
                        <th align="center">ID</th>
                        <th style="width: 1%">No. </th>
                        <th class="text-center">Nama Kategori</th>
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
            $("#KategoriTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getKategori",
                columns: [

                    { data: "id", name: "id", visible: false },
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "nm_kategori", name: "nm_kategori"},
                    { data: "actions", name: "actions", orderable: false, searchable: false }
                ],
                order: [[0, "asc"]],
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
