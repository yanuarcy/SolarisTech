@extends('Template.template')

@vite('resources/sass/Auth/SignUp.scss')

@section('Content')

    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="square" style="--i:0;"></div>
            <div class="square" style="--i:1;"></div>
            <div class="square" style="--i:2;"></div>
            <div class="square" style="--i:3;"></div>
            <div class="square" style="--i:4;"></div>
            <div class="container">
                <div class="form">
                    <h2>Register Form Admin</h2>
                    <form action="{{ route('Admin.store') }}" method="POST">
                        @csrf

                        <div class="inputBox">
                            <div class="row mb-4">
                                <div class="col-md-6 Username">
                                    <input id="name" class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Nama" autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 Email">
                                    <input id="email" class="@error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 Password">
                                    <input id="password" class="@error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 Telephone">
                                    <input id="telepone" class="@error('telepone') is-invalid @enderror" type="text" name="telepone" value="{{ old('telepone') }}" placeholder="0812-3456-7890" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}">
                                    @error('telepone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-white">
                                <div class="col-md-12 mb-3">
                                    <h5 class="mt-3">Gender</h5>
                                </div>
                                <div class="col-md-12 d-flex mb-3">
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input id="gender" class="form-check-input" type="radio" name="gender" value="Male" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input id="gender" class="form-check-input" type="radio" name="gender" value="Female" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="@error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30" rows="5" placeholder="Alamat"></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 inputBox">
                            <a class="Back" href="{{ route('Home') }}"><i class="bi-arrow-left-circle"></i> Back</a>
                            <input type="submit" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


