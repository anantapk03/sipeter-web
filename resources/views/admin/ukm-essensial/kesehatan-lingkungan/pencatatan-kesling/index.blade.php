@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('kesling.kegiatan.report', $data->id) }}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Pencatatan Kegiatan Kesehatan Lingkungan</h3>
            <a href="{{ route('kesling.kegiatan.report.create', ['id'=>$data->id, 'month'=>$month, 'status' => $status]) }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Resiko Rendah</th>
                        <th>Jumlah Resiko Sedang</th>
                        <th>Jumlah Resiko Tinggi</th>
                        <th>Jumlah Resiko Amat Tinggi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Resiko Rendah</th>
                        <th>Jumlah Resiko Sedang</th>
                        <th>Jumlah Resiko Tinggi</th>
                        <th>Jumlah Resiko Amat Tinggi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
