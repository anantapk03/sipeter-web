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
            <h3>Data Sasaran Program Imunisasi Baduta {{$monthName}} {{$year}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('jenis-imunisasi-baduta-index')}}"><i class="fas fa-book"></i> Jenis Imunisasi</a>
                    @if ($desa->isNotEmpty())
                    <a class="dropdown-item" href="{{route('sasaran-imunisasi-baduta-create')}}"><i class="fas fa-plus-circle"></i> Tambah Laporan Sasaran</a>
                    @endif
                    <a href="#" class="dropdown-item"><i class="flaticon-archive"></i> Arsip Laporan</a>
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
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Laki-laki</th>
                        <th>Perempuan</th>
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
                                {{$item->sasaran_laki}}
                            </td>
                            <td>
                                {{$item->sasaran_perempuan}}
                            </td>
                            <td>
                                @if (\App\Helpers\MonthHelper::checkJenisImunisasiBadutaInReport($item->id)->isNotEmpty())
                                <span class="badge badge-danger">Uncomplete</span>
                                @else
                                <span class="badge badge-success">Complete</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('laporan-imunisasi-baduta-index', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                <a href="{{route('sasaran-imunisasi-baduta-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
