@extends('admin.layouts.admin')
@section('content')

<a href="{{route('kegiatan-program-kia-gizi-UKS-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Kelas</h3>
            <a class="btn btn-primary" href="{{route('kegiatan-program-kia-gizi-UKS-kelas-siswa-create')}}"><i class="fas fa-plus-circle"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
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
                                {{$item->namaKelas}}
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"><i class="fas fa-eye"></i> Info</a>
                                <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Data {{$item->namaKelas}} </h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mt-3">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col">Deskripsi</th>
                                                            <td>:</td>
                                                            <td>{{ $item->deskripsi}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('kegiatan-program-kia-gizi-UKS-kelas-siswa-edit', ['idKelas'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection