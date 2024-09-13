@extends('admin.layouts.admin')
@section('content')

<a href="{{route('laporan-kegiatan-program-p2', ['id'=>$program->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Kegiatan Program Pengendalian Penyakit {{$program->categoryP2->namaCategory}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('kegiatan-p2-create', ['id'=>$program->id])}}"><i class="fas fa-plus-circle"></i> Tambah Kegiatan</a>
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
                        <th>Nama Kegiatan</th>
                        <th>Target Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah</th>
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
                                {{$item->namaKegiatan}}
                            </td>
                            <td>
                                {{$item->targetJumlah}}
                            </td>
                            <td>
                                <a href="{{route('kegiatan-p2-edit', ['id'=>$program->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                @if ($item->isActive)
                                <a href="{{route('kegiatan-p2-updateStatus', ['id'=>$program->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{route('kegiatan-p2-updateStatus', ['id'=>$program->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-danger">InActive</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
