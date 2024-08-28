@extends('admin.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Tambah data Program divisi Promosi Kesehatan</h3>
        </div>
        <form action="{{route('program-divisi-promosi-kesehatan-store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Program</label>
                    <input id="inputNamaKegiatan" type="text" name="namaProgram" class="form-control" required placeholder="Masukan Nama Program">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi Program</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Program"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('program-divisi-promosi-kesehatan')}}">Kembali</a>
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