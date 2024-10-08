@extends('admin.layouts.admin')
@section('panel-header')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">UKM Essensial</h2>
                <h5 class="text-white op-7 mb-2">Selamat datang di Divisi UKM Essensial</h5>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

    <div class="row ">
        @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::PROMOSI_KESEHATAN, $listAccessFeatures))
            <div class="col">
                <div class="card card-info card-annoucement card-round">
                    <div class="card-body text-center">
                        <div class="card-opening">Promosi Kesehatan</div>
                        <div class="card-desc">
                        </div>
                        <div class="card-detail">
                            <a href="{{ route('program-divisi-promosi-kesehatan') }}" class="btn btn-light btn-rounded">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::KESEHATAN_LINGKUNGAN, $listAccessFeatures))
            <div class="col">
                <div class="card card-info card-annoucement card-round">
                    <div class="card-body text-center">
                        <div class="card-opening">Kesehatan Lingkungan</div>
                        <div class="card-desc">
                        </div>
                        <div class="card-detail">
                            <a href="{{ route('kesling.kegiatan.index') }}" class="btn btn-light btn-rounded">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::KESEHATAN_IBU_ANAK_GIZI, $listAccessFeatures))
        <div class="col">
            <div class="card card-info card-annoucement card-round">
                <div class="card-body text-center">
                    <div class="card-opening">KIA & Kesehatan Gizi</div>
                    <div class="card-desc">
                    </div>
                    <div class="card-detail">
                        <a href="{{route('management-report-kia-gizi-index')}}" class="btn btn-light btn-rounded">View Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (\App\Helpers\DivisiHelper::isUserHaveAccess(\App\Helpers\DivisiHelper::PENCEGAHAN_PENGENDALIAN_PENYAKIT, $listAccessFeatures))
            <div class="col">
                <div class="card card-info card-annoucement card-round">
                    <div class="card-body text-center">
                        <div class="card-opening">Pengendalian Penyakit</div>
                        <div class="card-desc">
                        </div>
                        <div class="card-detail">
                            <a href="{{ route('pengendalian-penyakit.menu') }}" class="btn btn-light btn-rounded">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
