@extends('admin.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit data sub kegiatan program promosi kesehatan umum di desa/kelurahan</h3>
        </div>
        <form action="{{route('program-kegiatan-promkes-desa-update', ['id'=>$data->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Sub Kegiatan</label>
                    <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Sub Kegiatan" value="{{$data->namaKegiatan}}">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi Sub Kegiatan</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsiKegiatan" class="form-control" required placeholder="Masukan Deskripsi Sub Kegiatan">{{$data->deskripsiKegiatan}}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('program-kegiatan-promkes-desa-index')}}">Kembali</a>
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