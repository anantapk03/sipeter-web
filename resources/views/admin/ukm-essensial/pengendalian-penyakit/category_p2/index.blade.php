@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit.menu')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Kategori Program Pengendalian Penyakit</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('category-p2-create')}}"><i class="fas fa-plus-circle"></i> Tambah Kategori</a>
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
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->namaCategory}}
                            </td>
                            <td>
                                {{$item->deskripsi}}
                            </td>
                            <td>
                                @if ($item->isActive)
                                <a href="{{route('category-p2-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                <a href="{{route('category-p2-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">InActive</a>
                                @endif
                                <a href="{{route('category-p2-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-ediit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
