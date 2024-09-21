@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah data akses user</h3>
        </div>
        <form action="{{route('management-features-store', ['idUser'=>$user->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputJumlah">Nama</label>
                    <input id="inputJumlah" type="text" name="jumlah" class="form-control" required disabled value="{{$user->nama}}">
                </div> 
                <div class="form-group">
                    <label for="inputJumlah">Level Pengguna</label>
                    <input id="inputJumlah" type="text" name="jumlah" class="form-control" required disabled value="{{$user->level}}">
                </div> 
                <div class="form-group">
                    <label for="inpukNama">Daftar Akses</label>
                    <select type="text" name="idDivisi" class="form-control" required>
                        <option disabled selected value> -- select an option -- </option>
                        @foreach ($divisi as $item)
                            <option value="{{$item->id}}">{{$item->namaDivisi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('management-features-index', ['idUser'=>$user->id])}}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Peringatan!',
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