@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('promkes.show.activity')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Sub Kegiatan Program Promosi Kesehatan Desa / Kelurahan</h3>
                <a href="{{route('program-kegiatan-promkes-desa-create')}}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $item)
                            <tr style="width: fit-content">
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$item->namaKegiatan}}
                                </td>
                                <td>
                                    @if ($item->isActive)
                                    <a href="{{route('program-kegiatan-promkes-desa-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Active</a>
                                    @else
                                    <a href="{{route('program-kegiatan-promkes-desa-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i> Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <style>
                                            .dropdown-toggle::after {
                                                display: none;
                                            }
                                        </style>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">
                                                <a href="{{route('pencatatan-program-kegiatan-promkes-desa-index', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                            </div>
                                            <div class="dropdown-item">
                                                <a href="{{route('program-kegiatan-promkes-desa-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@endsection