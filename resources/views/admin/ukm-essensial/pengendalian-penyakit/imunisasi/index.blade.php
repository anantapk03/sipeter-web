@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Kegiatan Imunisasi</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Imunisasi Bayi</td>
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
                                    <a class="dropdown-item" href="#"><i class="fas fa-database" style="margin-right: 3%"></i>  Data Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Imunisasi Bayi dibawah Dua Tahun</td>
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
                                    <a class="dropdown-item" href="#"><i class="fas fa-database" style="margin-right: 3%"></i>  Data Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Imunisasi Wanita Usia Subur</td>
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
                                    <a class="dropdown-item" href="#"><i class="fas fa-database" style="margin-right: 3%"></i> Data Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection