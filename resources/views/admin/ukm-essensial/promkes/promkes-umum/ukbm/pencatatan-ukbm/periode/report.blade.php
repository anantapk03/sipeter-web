@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('ukbm.data-ukbm.index') }}" class="btn btn-danger mb-3"><i class="fas fa-left-arrow"></i>Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3> Laporan Bulanan Pencatatan Data UKBM</h3>
            <a class="btn btn-sm btn-success" href="{{ route('ukbm.pencatatan-ukbm.periode.create') }}"> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables3" class="display table table-striped table-hover">
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
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->bulan }}</td>
                            <td>
                                @if ($item->is_disabled)
                                    <a class="btn btn-sm btn-info" href="{{ route('ukbm.pencatatan-ukbm.index', $item->id) }}">Lihat Laporan</a>
                                @else
                                    <a class="btn btn-sm btn-success" href="{{ route('ukbm.pencatatan-ukbm.index', $item->id) }}">Buat Laporan</a>
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