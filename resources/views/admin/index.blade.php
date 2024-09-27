@extends('admin.layouts.admin')
@section('panel-header')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Sistem Pencatatan & Pelaporan Terpadu Puskesmas - Dashboard</h2>
                <h5 class="text-white op-7 mb-2">Selamat Datang, {{ Auth::user()->nama }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

    @if (auth()->user()->level == "Admin")
    <div class="row mt--5">
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
    @endif

    @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::PROMOSI_KESEHATAN, $listAccessFeatures))
        
    @endif

    @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::KESEHATAN_LINGKUNGAN, $listAccessFeatures))
    
    @endif

    @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::KESEHATAN_IBU_ANAK_GIZI, $listAccessFeatures))
    <div class="row">
        <div class="col-md-6">
            <x-visualisasi-data-kia-gizi />
        </div>
        <div class="col-md-6">
            <x-visualisasi-kia-gizi-2 />
        </div>
    </div>
    @endif

    @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::PENCEGAHAN_PENGENDALIAN_PENYAKIT, $listAccessFeatures))
    
    @endif

        
@endsection