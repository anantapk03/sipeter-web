@extends('admin.layouts.admin')
@section('content')
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
                                <a class="btn btn-sm btn-success" href="{{ route('ukbm.pencatatan-ukbm.index', $item->id) }}"
                                    @if ($item->is_disabled) disabled @endif> Laporan Bulanan</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('ukbm.data-ukbm.index') }}" class="btn btn-warning" style="margin-left: 1%">Kembali</a>
        </div>
    </div>
</div>
@endsection