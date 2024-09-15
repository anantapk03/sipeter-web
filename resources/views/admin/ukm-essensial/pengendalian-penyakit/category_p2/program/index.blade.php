@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit.menu')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Program Pengendalian Penyakit {{$category->namaCategory}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('program-p2-create', ['id'=>$category->id])}}"><i class="fas fa-plus-circle"></i> Tambah Program</a>
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
                        <th>Nama Program</th>
                        <th>Status Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Status Laporan</th>
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
                                {{$item->namaProgram}}
                            </td>
                            <td>
                                @if (\App\Helpers\MonthHelper::checkReportP2InThisMonth($item->id)->isNotEmpty())
                                <span class="badge badge-danger">Uncomplete</span>
                                @else
                                <span class="badge badge-success">Complete</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('laporan-kegiatan-program-p2', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                @if ($item->isActive)
                                <a href="{{route('program-p2-updateStatus', ['id'=>$category->id, 'idProgram'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{route('program-p2-updateStatus', ['id'=>$category->id, 'idProgram'=>$item->id])}}" class="btn btn-sm btn-danger">InActive</a>
                                @endif
                                <a href="{{route('program-p2-edit', ['id'=>$category->id, 'idProgram'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-ediit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
