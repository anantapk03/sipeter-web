@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Pengguna {{$level}}</h3>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inpukNama">Nama</label>
                    <input id="inputNama" type="text" name="nama" class="form-control" required placeholder="Masukan Nama Pengguna">
                </div>
                <div class="form-group">
                    <label for="inpukNama">NIP</label>
                    <input id="inputNama" type="text" name="nip" class="form-control" required placeholder="Masukan NIP Pengguna">
                </div>
                <div class="form-group">
                    <label for="inpukNama">Username</label>
                    <input id="inputNama" type="text" name="username" class="form-control" required placeholder="Masukan Username Pengguna">
                </div>
                <div class="form-group">
                    <label for="imageUrl">Profile Picture</label>
                    <input id="imageUrl" type="file" name="imageUrl" class="form-control" required>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('admin-management-users',['level'=>$level])}}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Batal Menginputkan Data Pengguna?',
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