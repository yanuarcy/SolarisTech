@extends('Template.template')

@vite ('resources/sass/Layouts/nav.scss')
@vite ('resources/sass/Layouts/footer.scss')
@vite ('resources/sass/app/about.scss')

@section('Content')
    @include('Layouts.nav')
    <section class="About text-white" id="section-about">
        <div class="container">
            <div class="row contentAbout">
                <div class="col textabout">
                    <h4>Solaris is an online store website that sells various electronics.</h4>
                    <h4>Our passion towards computers makes us willing to introduce and provide the most advanced and
                        recommeded products to our customers.</h4>
                    <h4>Besides selling Computer Component, our staff will also provide build guides for those who was new
                        to build their PC. We will recommend and help you build your perfect PC according to your budget.
                    </h4>
                    <h4>Solaris also continuously update prices from dozens of the most popular online retailers to help you
                        to save your money.</h4>
                </div>
                <div class="col gambar">
                    <img src="{{ Vite::asset('resources/images/SolarisAbout.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    @include('Layouts.footer')
@endsection
