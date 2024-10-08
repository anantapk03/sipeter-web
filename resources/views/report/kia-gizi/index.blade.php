@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('management-report-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Laporan Bulanan - Divisi KIA GIZI - Bulan {{$monthName}} - {{$tahun}}</h3>
                <div class="dropdown show">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fas fa-plus-circle"></i> Arsip Laporan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- There are 3 section --}}
            {{-- SECTION 1 = REPORT DOESN'T GENERATE --}}

            <div class="row">
                @if ($isAlreadyGenerateKiaGizi)
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col" id="DoesntreportKiaGizi">
                        <div class="card card-danger card-annoucement card-round">
                            <div class="card-body text-center">
                                <div class="card-opening">Report Laporan KIA & Gizi</div>
                                <div class="card-desc">
                                    <h5>
                                        Klik tombol di bawah ini untuk mulai menggenerate laporan KIA & Gizi
                                    </h5>
                                </div>
                                <div class="card-detail">
                                    <a href="#" class="btn btn-light btn-rounded">Generate Laporan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($isAlreadyGenerateUks)
                    <div class="col" id="doneGenerateReportUks">

                    </div>
                @else
                    <div class="col" id="DoesntReportUks">
                        <div class="card card-danger card-annoucement card-round">
                            <div class="card-body text-center">
                                <div class="card-opening">Report Usaha Kesehatan Sekolah</div>
                                <div class="card-desc">
                                    <h5>
                                        Klik tombol di bawah ini untuk mulai menggenerate laporan Usaha Kesehatan Sekolah
                                    </h5>
                                </div>
                                <div class="card-detail">
                                    <a href="#" class="btn btn-light btn-rounded">Generate Laporan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>    
@endsection