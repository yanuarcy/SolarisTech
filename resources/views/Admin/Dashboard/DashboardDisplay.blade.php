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
                    <h4>8</h4>
                </div>
                <div class="footer">
                    <h6 style="display: inline-block; margin-right: 10%;">User : 6</h6>
                    <h6 style="display: inline-block">Admin : 2</h6>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h5>Product</h5>
                </div>
                <div class="main">
                    <h4>15</h4>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h5>Category</h5>
                </div>
                <div class="main">
                    <h4>4</h4>
                </div>
            </div>
            <div class="card">
                <div class="header">
                    <h5>Total Revenue</h5>
                </div>
                <div class="main">
                    <h4>Rp 45.600.000</h4>
                </div>
                <div class="footer">
                    <h6>Sales : 167</h6>
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
                    <h6>76 Sales this month</h6>
                </div>
                <!-- You can add a list of recent sales here using JavaScript -->
            </div>
        </div>
    </div>
</div>
@endsection
