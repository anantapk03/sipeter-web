@extends('admin.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Memperbarui data Kegiatan Program KIA & Gizi</h3>
        </div>
        <form action="{{route('program-kia-gizi-update', ['id'=>$data->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Kegiatan</label>
                    <input id="inputNamaKegiatan" type="text" name="namaProgram" class="form-control" required placeholder="Masukan Nama Kegiatan" value="{{$data->namaProgram}}">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi Kegiatan</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Kegiatan">{{$data->deskripsi}}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('program-kia-gizi-index')}}">Kembali</a>
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