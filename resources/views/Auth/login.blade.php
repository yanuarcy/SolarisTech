@extends('Template.template')

@vite('resources/sass/Auth/SignIn.scss')

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
                    <h2>Login Form</h2>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="inputBox">
                            <input id="email" class="@error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="inputBox">
                            <input id="password" class="@error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="inputBox">
                            <a class="Back" href="{{ route('Home') }}"><i class="bi-arrow-left-circle"></i> Back</a>
                            <input type="submit" value="Login">
                        </div>
                        <p class="forget">Forgot Password ? <a href="#">Click Here</a></p>
                        <p class="forget">Don't have an account ? <a href="{{ route('register') }}">Sign Up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
