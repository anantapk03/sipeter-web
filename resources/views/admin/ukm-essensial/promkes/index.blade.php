@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Program Divisi Promosi Kesehatan</h3>
            <div class="dropdown show" style="margin-left: 55%">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('program-divisi-promosi-kesehatan-create') }}"><i class="fas fa-plus"></i> Tambah</a>
                    <a class="dropdown-item" href="{{ route('promkes.statistic') }}"><i class="fas fa-chart-bar"></i> Statistic</a>
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
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Promosi Kesehatan Umum Desa</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success disabled"><i class="fas fa-edit"></i> Active</a>
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
                                    <a class="dropdown-item" href="{{ route('promkes.show.activity') }}"><i class="fas fa-database"></i>  Data Program</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration+1}}
                            </td>
                            <td>
                                {{$item->namaProgram}}
                            </td>
                            <td>
                                @if ($item->isActive)
                                <a href="{{route('program-divisi-promosi-kesehatan-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Active</a>
                                @else
                                <a href="{{route('program-divisi-promosi-kesehatan-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i> Inactive</a>
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
                                            <a href="{{route('kegiatan-program-divisi-promkes-index', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                        </div>
                                        <div class="dropdown-item">
                                            <a href="{{route('program-divisi-promosi-kesehatan-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
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
