@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit.imunisasi')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
@if ($desa->isEmpty())
<div class="alert alert-success">
    <h4>
        <span class="badge badge-success mr-3">
            <i class="flaticon-success" style="font-size: 24px;"></i>
        </span>
        Periksa laporan pencatatan pada masing-masing desa
    </h4>
</div>       
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Sasaran Program Imunisasi Bayi {{$monthName}} {{$year}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-index')}}"><i class="fas fa-book"></i> Jenis Imunisasi</a>
                    @if ($desa->isNotEmpty())
                    <a class="dropdown-item" href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-create')}}"><i class="fas fa-plus-circle"></i> Tambah Laporan Sasaran</a>
                    @endif
                    <a href="{{route('pengendalian-penyakit-imunisai-bayi-arsip')}}" class="dropdown-item"><i class="flaticon-archive"></i> Arsip Laporan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Sasaran Bayi</th>
                        <th>Sasaran Surviving Infant</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Sasaran Bayi</th>
                        <th>Sasaran Surviving Infant</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->desa->namaDesa}}
                            </td>
                            <td>
                                {{$item->jumlah_sasaran_bayi_laki + $item->jumlah_sasaran_bayi_perempuan}}
                            </td>
                            <td>
                                {{$item->jumlah_surviving_infant_laki+$item->jumlah_surviving_infant_perempuan}}
                            </td>
                            <td>
                                @if (\App\Helpers\MonthHelper::checkJenisImunisasiInReport($item->id)->isNotEmpty())
                                <span class="badge badge-danger">Uncomplete</span>
                                @else
                                <span class="badge badge-success">Complete</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('P2-Laporan-Imunisasi', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                <a href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
