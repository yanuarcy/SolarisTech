@extends('Template.template')

@section('Content')
    <div class="container-sm my-5">
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 col-xl-4 border">

                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Detail Profile</h4>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName" class="form-label">Nama</label>
                        <h5>{{ Auth::user()->name }}</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="lastName" class="form-label">Email</label>
                        <h5>{{ Auth::user()->email }}</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Telepone</label>
                        <h5>{{ Auth::user()->telepone }}</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="age" class="form-label">Gender</label>
                        <h5>{{ Auth::user()->gender }}</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="age" class="form-label">Alamat</label>
                        <h5>{{ Auth::user()->alamat }}</h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('Home') }}" class="btn btn-outline-dark btn-lg w-100 mt-3"><i class="bi-arrow-left-circle me-2"></i> Back</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('HistoryOrder') }}" class="btn btn-primary btn-lg w-100 mt-3"> History Order</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
