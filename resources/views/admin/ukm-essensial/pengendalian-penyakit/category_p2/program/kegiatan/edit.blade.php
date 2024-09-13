@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Kegiatan Program Pengendalian Penyakit {{$program->namaProgram}}</h3>
        </div>
        <form action="{{route('kegiatan-p2-update', ['id'=>$program->id, 'idKegiatan'=>$data->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Kegiatan</label>
                    <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Kegiatan" value="{{$data->namaKegiatan}}">
                </div>
                <div class="form-group">
                    <label for="inputNamaKegiatan">Target Jumlah / Bulan</label>
                    <input id="inputNamaKegiatan" type="number" min="0" name="targetJumlah" class="form-control" required placeholder="Masukan Target Jumlah" value="{{$data->targetJumlah}}">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi"> {{$data->deskripsi}} </textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Perbarui</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('kegiatan-p2-index', ['id'=>$program->id])}}">Kembali</a>
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