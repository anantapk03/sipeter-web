@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('pengendalian-penyakit.imunisasi') }}" class="btn btn-danger mb-2"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Imunisasi Wanita Usia Subur</h3>
            <div class="dropdown show">
                <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('imunisasi-wus.jenis') }}"><i class="fas fa-book"></i> Data Jenis</a>
                    <a class="dropdown-item" href="{{ route('imunisasi-wus.sasaran.create') }}"><i class="fas fa-plus-circle"></i> Tambah Sasaran</a>
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
                        <th>Desa</th>
                        <th>Jumlah Sasaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Jumlah Sasaran</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaDesa }}</td>
                            <td>{{ $item->jumlahSasaran }}</td>
                            <td>
                                <a href="{{ route('imunisasi-wus.laporan.index', $item->id) }}" class="btn btn-sm btn-info">Info</a>
                                <a href="{{ route('imunisasi-wus.sasaran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                                
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
