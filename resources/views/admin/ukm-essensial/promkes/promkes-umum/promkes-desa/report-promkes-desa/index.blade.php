@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Report Sub {{$data->namaKegiatan}} Periode {{$year}}</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr id="januari">
                        <td>
                            1
                        </td>
                        <td>
                            Januari
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success"> <i class="fas fa-document"></i>Buat Laporan</a>
                        </td>
                    </tr>
                    <tr id="Februari">
                        <td>
                            2
                        </td>
                        <td>
                            Februari
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success"> <i class="fas fa-document"></i>Buat Laporan</a>
                        </td>
                    </tr>
                    <tr id="Maret">
                        <td>
                            3
                        </td>
                        <td>
                            Maret
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success"> <i class="fas fa-document"></i>Buat Laporan</a>
                        </td>
                    </tr>
                    <tr id="April">
                        <td>
                            4
                        </td>
                        <td>
                            April
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success"> <i class="fas fa-document"></i>Buat Laporan</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection