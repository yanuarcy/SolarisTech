@extends('Admin.Sidebar')


@vite('resources/sass/Admin/Dashboard/index.scss')
@section('contentdashboard')
<div class="container">
    <div class="row">
        <div class="InfoPanel">

            <div class="card">
                <div class="header">
                    <h5>Member</h5>
                </div>
                <div class="main">
                    <h4>{{ $MemberCount }}</h4>
                </div>
                <div class="footer">
                    <h6 style="display: inline-block; margin-right: 10%;">User : {{ $UserCount }}</h6>
                    <h6 style="display: inline-block">Admin : {{ $AdminCount }}</h6>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h5>Product</h5>
                </div>
                <div class="main">
                    <h4>{{ $ProductCount }}</h4>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h5>Category</h5>
                </div>
                <div class="main">
                    <h4>{{ $KategoriCount }}</h4>
                </div>
            </div>

            <div class="card">
                <div class="header">
                    <h5>Total Revenue</h5>
                </div>
                <div class="main">
                    <h4>Rp {{ number_format($TotalRevenue, 0, ',', '.') }}</h4>
                </div>
                <div class="footer">
                    <h6>Sales : {{ $TotalSales }}</h6>
                </div>
            </div>

        </div>

        <div class="mainDashboard">
            <div class="bar-chart">
                <div class="header">
                    <h4>Overview</h4>
                </div>
                <!-- You can add your bar chart here using JavaScript or any chart library -->
            </div>
            <div class="recent-sales">
                <div class="header">
                    <h4>Recent Sales</h4>
                    <h6>{{ $TotalSales }} Sales this month</h6>
                </div>
                <div class="Box">
                    <div class="MainRecentSales">
                        @foreach ($Transaksis as $Transaksi )
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <h5>{{ $Transaksi->nm_member }}</h5>
                                        <h6>{{ $Transaksi->email }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h5>Rp {{ number_format($Transaksi->jml_transaksi) }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- You can add a list of recent sales here using JavaScript -->
            </div>
        </div>
    </div>
</div>
@endsection
