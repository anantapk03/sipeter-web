@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('admin-management-users', ['level'=>$user->level])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Akses Fitur {{$user->name}}</h3>
                <a href="{{route('management-features-create', ['idUser'=>$user->id])}}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Features</th>
                            <th>Status Keanggotaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Features</th>
                            <th>Status Keanggotaan</th>
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
                                    {{$item->divisi->namaDivisi}}
                                </td>
                                <td>
                                    @if ($item->isLeader)
                                        <a href="{{route('management-features-editLeader', ['idAccessFeature'=>$item->id])}}" class="btn btn-sm btn-success">Ketua Divisi</a>
                                    @else
                                        <a href="{{route('management-features-editLeader', ['idAccessFeature'=>$item->id])}}" class="btn btn-sm btn-default">Anggota</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                                    <a href="{{route('management-features-edit', ['idAccessFeature'=>$item->id, 'idUser'=>$user->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" id="deleteConfirmation{{$item->id}}" data-href="{{route('management-features-destroy', ['idAccessFeature'=>$item->id])}}" data-name="Akses pada {{$item->divisi->namaDivisi}} pada user {{$item->user->nama}}" class="btn btn-sm btn-danger mr-2 mt-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
                                    {{-- Start delete confirmation --}}
                                    <script>
                                        $("#deleteConfirmation"+{{$item->id}}).click(function () {
                                            swal({
                                                title: 'Peringatan!',
                                                text: "Data "+$(this).data('name')+" Akan Dihapus",
                                                type: 'warning',
                                                buttons:{
                                                    confirm: {
                                                        text: 'Hapus Data',
                                                        className : 'btn btn-success',
                                                    },
                                                    cancel: {
                                                        visible: true,
                                                        text : 'Batalkan',
                                                        className: 'btn btn-danger',
                                                    }
                                                }
                                            }).then((willConfirm) => {
                                                if (willConfirm) {
                                                    window.location.href = $(this).data('href');
                                                } 
                                            });
                                        });
                                    </script>
                                    {{-- End of delete confirmation --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection