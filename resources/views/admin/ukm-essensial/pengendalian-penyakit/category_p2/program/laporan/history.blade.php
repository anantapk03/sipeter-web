@extends('admin.layouts.admin')
@section('content')

<a href="{{route('laporan-kegiatan-program-p2', ['id'=>$program->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3> Arsip Laporan Kegiatan Program Pengendalian Penyakit {{$program->categoryP2->namaCategory}} {{$program->namaProgram}} Bulan {{$monthName}} {{$year}}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->tahun}} {{\App\Helpers\MonthHelper::getMonth($item->bulan)}}
                            </td>
                            <td>
                                {{$item->kegiatanProgramPengendalianPenyakit->namaKegiatan}}
                            </td>
                            <td>
                                {{$item->jumlah}}
                            </td>
                            <td>
                                {{$item->deskripsi}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
