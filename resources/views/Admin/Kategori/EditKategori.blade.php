@extends('Admin.Sidebar')

@vite([
    'resources/sass/Admin/Stuff/create.scss',
    'resources/js/Produk/CreateProduk.js'
])

@section('contentdashboard')

    <div class="container-sm mt-5">
        <form action="{{ route('Kategori.update', $Kategoris->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">


                    <div class="mb-3 text-center">
                        <i class="bi-person-circle fs-1"></i>
                        <h4>Edit Category</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nm_kategori" class="form-label">Nama Kategori</label>
                            <input class="form-control @error('nm_kategori') is-invalid @enderror" type="text" name="nm_kategori" id="nm_kategori" value="{{ $Kategoris->nm_kategori }}" placeholder="Masukkan Nama Kategori">
                            @error('nm_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('Kategori.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
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
