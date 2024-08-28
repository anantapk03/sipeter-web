@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Kegiatan Promosi Kesehatan Umum</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kegiatan Promosi Kesehatan di Desa</td>
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
                                    <a class="dropdown-item" href="{{route('program-kegiatan-promkes-desa-index')}}"><i class="fas fa-database"></i>  Info</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pencatatan UKBM yang dibina Puskesmas</td>
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
                                    <a class="dropdown-item" href="{{ route('ukbm.data-ukbm.index') }}"><i class="fas fa-database"></i>  Info</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('program-divisi-promosi-kesehatan') }}" class="btn btn-warning" style="margin-left: 1%">Kembali</a>
        </div>
    </div>
</div>
@endsection
