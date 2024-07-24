@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Pengguna {{$level}}</h3>
            <a href="{{route('admin-add-management-users', ['level'=>$level])}}" class="btn btn-primary">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->nama}}</td>
                            <td>
                                @if ($user->status == "active")
                                <span class="badge badge-success">{{$user->status}}</span>
                                @else
                                <span class="badge badge-danger">{{$user->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$user->id}}" data-toggle="modal"> <i class="fas fa-info"></i> Info</a>
                                {{-- Modal start --}}
                                <div class="modal fade" id="exampleModalCenter{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLongTitle">Data Pengguna</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <div class="avatar avatar-xl">
                                                    <img src="{{asset('storage/picture_profile/'.$user->imageUrl)}}" alt="..." class="avatar-img rounded-circle">
                                                </div>
                                            </center>
                                            <table class="table mt-3">
                                                <tbody>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <td>:</td>
                                                        <td>{{ $loop->iteration }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Nama</th>
                                                        <td>:</td>
                                                        <td> {{$user->nama}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Username</th>
                                                        <td>:</td>
                                                        <td> {{$user->username}} </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Role</th>
                                                        <td>:</td>
                                                        <td> {{$user->level}} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="{{route('admin-edit-management-users', ['id'=>$user->id, 'level'=>$user->level])}}" class="btn btn-warning">Edit Data</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                {{-- Modal end --}}
                                <a href="{{route('admin-updatePassword-management-users', ['id'=>$user->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-redo"></i> Password</a>
                                <a href="#" data-href="{{route('admin-delete-management-users', ['id'=>$user->id])}}" data-name="{{$user->nama}}" class="btn btn-sm btn-danger" id="deleteConfirmation{{$user->id}}"><i class="fas fa-trash"></i> Hapus</a>
                                {{-- JS DELETE CONFIRMATION --}}
                                <script>
                                    $("#deleteConfirmation"+{{$user->id}}).click(function () {
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
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection