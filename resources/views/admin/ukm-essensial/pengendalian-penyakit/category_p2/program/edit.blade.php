@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Program Pengendalian Penyakit {{$category->namaCategory}}</h3>
        </div>
        <form action="{{route('program-p2-update', ['id'=>$category->id, 'idProgram'=>$data->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaCategory">Nama Program</label>
                    <input id="inputNamaProgram" type="text" name="namaProgram" class="form-control" required placeholder="Masukan Nama Program" value="{{$data->namaProgram}}">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiImunisasi">Deskripsi</label>
                    <textarea id="inputDeskripsiImunisasi" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi"> {{$data->deskripsi}} </textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Perbarui</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('program-p2-index', ['id'=>$category->id])}}">Kembali</a>
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