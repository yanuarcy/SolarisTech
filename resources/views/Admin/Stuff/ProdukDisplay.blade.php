@extends('Admin.Dashboard')


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
        <div class="table-responsive border p-3 rounded-3">
            <table class="table table-bordered table-hover table-striped mb-0 bg-white">
                <thead>
                    <tr>
                        <th>Kategori ID</th>
                        <th>Member ID</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Stok</th>
                        <th>Deskripsi Produk</th>
                        <th>Foto Produk</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
