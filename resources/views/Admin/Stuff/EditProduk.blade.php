@extends('Admin.Sidebar')

@vite([
    'resources/sass/Admin/Stuff/create.scss',
    'resources/js/Produk/CreateProduk.js'
])

@section('contentdashboard')

    <div class="container-sm mt-5">
        <form action="{{ route('Product.update', $products->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">


                    <div class="mb-3 text-center">
                        <i class="bi-person-circle fs-1"></i>
                        <h4>Edit Product</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input class="form-control @error('nama_produk') is-invalid @enderror" type="text" name="nama_produk" id="nama_produk" value="{{ $products->nm_produk }}" placeholder="Masukkan Nama Produk">
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select">
                                @foreach ($Kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $products->kategori->nm_kategori == $kategori->nm_kategori ? 'selected' : '' }}>{{ $kategori->nm_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input class="form-control @error('stok') is-invalid @enderror" type="text" name="stok" id="stok" value="{{ $products->stok }}" placeholder="Masukkan Stok">
                                @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <input class="form-control @error('harga_produk') is-invalid @enderror" type="text" name="harga_produk" id="harga_produk" value="Rp {{ number_format($products->hg_produk, 0, ',', '.') }}" placeholder="Masukkan Harga Produk">
                                @error('harga_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="desc_produk" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" name="desc_produk" id="desc_produk" cols="50" rows="5"></textarea>
                            @error('desc_produk')
                                <div class="invalid-feedback"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3 d-block">
                            <label for="gambar" class="form-label">Gambar</label>
                            <img src="{{ Vite::asset('resources/images/'. $products->photo) }}" style="width: 100px" alt="">
                            <input type="file" class="form-control" name="gambar" id="gambar">
                            @error('gambar')
                                <div class="invalid-feedback"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('Product.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
