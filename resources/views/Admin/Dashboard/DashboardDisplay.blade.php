@extends('Admin.Sidebar')


@vite('resources/sass/Admin/Dashboard/index.scss')
@section('contentdashboard')
    <div class="container Dashboard">
        <div class="row">
            <div class="headerTittle">
                <h2 class="Tittle">{{ $Tittle }}</h2>
            </div>
            <div class="InfoPanel">

                <div class="card Member">
                    <div class="header">
                        <h5>Member</h5>
                    </div>
                    <div class="main text-white">
                        <h4>{{ $MemberCount }}</h4>
                    </div>
                    <div class="footer">
                        <h6 style="display: inline-block; margin-right: 10%;">User : {{ $UserCount }}</h6>
                        <h6 style="display: inline-block">Admin : {{ $AdminCount }}</h6>
                    </div>
                </div>

                <div class="card Product">
                    <div class="header">
                        <h5>Product</h5>
                    </div>
                    <div class="main text-white">
                        <h4>{{ $ProductCount }}</h4>
                    </div>
                </div>

                <div class="card Kategori">
                    <div class="header">
                        <h5>Category</h5>
                    </div>
                    <div class="main text-white">
                        <h4>{{ $KategoriCount }}</h4>
                    </div>
                </div>

                <div class="card TotalRevenue">
                    <div class="header">
                        <h5>Total Revenue</h5>
                    </div>
                    <div class="main text-white">
                        <h4>Rp {{ number_format($TotalRevenue, 0, ',', '.') }}</h4>
                    </div>
                    <div class="footer">
                        <h6>Sales : {{ $TotalSales }}</h6>
                    </div>
                </div>

            </div>

            <div class="mainDashboard">
                <div class="column">
                    <div class="bar-chart">
                        <div class="header text-white">
                            <h4>Overview</h4>
                        </div>
                        @php
                            $data = [
                                [
                                    'name' => 'Jan',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Feb',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Mar',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Apr',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Mei',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Jun',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Jul',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Aug',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Sept',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Okt',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Nov',
                                    'total' => rand(40000000, 280000000),
                                ],
                                [
                                    'name' => 'Dec',
                                    'total' => rand(40000000, 280000000),
                                ],
                                // ... tambahkan data untuk bulan-bulan lainnya
                            ];
                        @endphp
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="column">
                    <div class="recent-sales">
                        <div class="header">
                            <h4>Recent Sales</h4>
                            <h6 class="SalesTotal">{{ $TotalSales }} Sales this month</h6>
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
                                                <h5 class="nama">{{ $Transaksi->nm_member }}</h5>
                                                <h6 class="email">{{ $Transaksi->email }}</h6>
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
    </div>
@endsection

@push('scripts')
    <script>
        var data = @json($data);

        var options = {
            chart: {
                type: 'bar',
                height: 400,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 4
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'category',
                categories: data.map(item => item.name),
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#888888',
                    },
                },
                tickPlacement: 'on',
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                gridLines: {
                    show: false
                },
                labels: {
                    style: {
                        fontSize: '12px',
                        colors: '#888888',
                    },
                    formatter: function (value) {
                        return 'Rp' + value.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 });
                    }
                },
                tickAmount: 5,
                max: 300000000,
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            fill: {
                colors: ['#adfa1d'],
            },
            series: [{
                name: 'Total',
                data: data.map(item => item.total),
            }]
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endpush
