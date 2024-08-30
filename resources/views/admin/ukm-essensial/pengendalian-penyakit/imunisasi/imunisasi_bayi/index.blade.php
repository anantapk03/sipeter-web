@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit.imunisasi')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Sasaran Program Imunisasi Bayi {{$monthName}} {{$year}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fas fa-book"></i> Jenis Imunisasi</a>
                    @if ($desa->isNotEmpty())
                    <a class="dropdown-item" href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-create')}}"><i class="fas fa-plus-circle"></i> Tambah Laporan Sasaran</a>
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
                        <th>Jumlah Sasaran Bayi</th>
                        <th>Jumlah Sasaran Surviving Infant</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Jumlah Sasaran Bayi</th>
                        <th>Jumlah Sasaran Surviving Infant</th>
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
                                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
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
