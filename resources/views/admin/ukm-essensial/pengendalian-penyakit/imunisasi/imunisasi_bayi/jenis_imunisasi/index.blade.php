@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Jenis Imunisasi Bayi</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-create')}}"><i class="fas fa-plus-circle"></i> Tambah Jenis</a>
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
                        <th>Jenis Imunisasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Jenis Imunisasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td> {{$item->namaImunisasi}} </td>
                            <td>
                                @if ($item->isActive)
                                    <a href="{{route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger"> Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                <a href="{{route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
