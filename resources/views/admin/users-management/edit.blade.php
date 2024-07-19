@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Pengguna {{$level}}</h3>
        </div>
        <form action="{{route('admin-update-management-users', ['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <center>
                    <div class="avatar avatar-xxl">
                        <img src="{{asset('storage/picture_profile/'.$user->imageUrl)}}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </center>
                <div class="form-group">
                    <label for="inpukNama">Nama</label>
                    <input id="inputNama" type="text" name="nama" class="form-control" required placeholder="Masukan Nama Pengguna" value="{{$user->nama}}">
                </div>
                <div class="form-group">
                    <label for="inpukNama">NIP</label>
                    <input id="inputNama" type="text" name="nip" class="form-control" required placeholder="Masukan NIP Pengguna" value="{{$user->nip}}">
                </div>
                <div class="form-group">
                    <label for="inpukNama">Username</label>
                    <input id="inputNama" type="text" name="username" class="form-control" required placeholder="Masukan Username Pengguna" value="{{$user->username}}">
                </div>
                <div class="form-group">
                    <label for="inpukNama">Level</label>
                    <select type="text" name="level" class="form-control" required placeholder="Jabatan Pengguna...">
                        <option value="{{$user->level}}">{{$user->level}}</option>
                        @if ($user->level == "Admin")
                        <option value="Petugas UKM">Petugas UKM</option>
                        <option value="Kepala Puskesmas">Kepala Puskesmas</option>         
                        @endif
                        @if ($user->level == "Petugas UKM")
                        <option value="Admin">Admin</option>
                        <option value="Kepala Puskesmas">Kepala Puskesmas</option>
                        @endif
                        @if ($user->level == "Kepala Puskesmas")
                        <option value="Admin">Admin</option>
                        <option value="Petugas UKM">Petugas UKM</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="inpukNama">Status</label>
                    <select type="text" name="status" class="form-control" required placeholder="Jabatan Pengguna...">
                        <option value="{{$user->status}}">{{$user->status}}</option>
                        @if ($user->status == "active")
                        <option value="inactive">inactive</option>
                        @else
                        <option value="active">active</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="imageUrl">Profile Picture</label>
                    <input id="imageUrl" type="file" name="imageUrl" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Perbarui</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('admin-management-users',['level'=>$level])}}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Peringatan !',
                            text: "Semua perubahan tidak akan disimpan",
                            type: 'warning',
                            buttons:{
                                confirm: {
                                    text: 'Kembali',
                                    className : 'btn btn-danger',
                                },
                                cancel: {
                                    visible: true,
                                    text : 'Lanjutkan Mengisi Data',
                                    className: 'btn btn-success',
                                }
                            }
                            }).then((willConfirm) => {
                            if (willConfirm) {
                                window.location.href = $(this).data('href');
                            }
                        });
                    });
                </script>
            </div>
        </form>
    </div>
@endsection