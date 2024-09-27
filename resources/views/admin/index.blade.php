@extends('admin.layouts.admin')
@section('content')
    <h2 class="mb-3">Selamat Datang, {{ Auth::user()->nama }}</h2>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">User</p>
                                    <h4 class="card-title">{{ $user->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Desa</p>
                                    <h4 class="card-title">{{ $desa->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="flaticon-graph"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">UKM Essensial</p>
                                    <h4 class="card-title">3</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="flaticon-success"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">UKM Pengembangan</p>
                                    <h4 class="card-title">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title mb-2 fw-mediumbold">Data Promosi Kesehatan</h4>
                </div>
                <div id="chart-container-promkes">
                    <canvas id="doughnutCharts" style="width: 300px; height:300px"></canvas>
                </div>
            </div>

            <div class="card" style="width: 30rem; margin-left:2%">
                <div class="card-body">
                    <h4 class="card-title mb-2 fw-mediumbold">Data Kesehatan Lingkungan</h4>
                <div id="chart-container">
                    <canvas id="doughnutChart" style="width: 300px; height:300px"></canvas>
                </div>
            
                <script>
                    var doughnutChart = document.getElementById('doughnutChart').getContext('2d');
                    var jumlah = {!! $jumlah !!};
                    var data = {!! $kegiatan !!};
                    //console.log(jumlah);
                    var myDoughnutChart = new Chart(doughnutChart, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: jumlah,
                                backgroundColor: ['#f3545d','#fdaf4b','#1d7af3']
                            }],

                            labels: data
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend : {
                                position: 'bottom'
                            },
                            layout: {
                                padding: {
                                    left: 20,
                                    right: 20,
                                    top: 20,
                                    bottom: 20
                                }
                            }
                        }
                    });
                </script>
                </div>
            </div>
        </div>

        <x-visualisasi-data-kia-gizi />
        <x-visualisasi-kia-gizi-2 />
        
@endsection