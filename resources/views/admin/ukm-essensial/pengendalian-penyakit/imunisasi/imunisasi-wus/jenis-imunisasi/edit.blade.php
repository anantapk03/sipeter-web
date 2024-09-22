@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Data Jenis Imunisasi</h3>
        </div>
        <form action="{{ route('imunisasi-wus.jenis.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jenis</label>
                            <input id="inputJenisUkbm" type="text" name="jenis" class="form-control" required value="{{ $data->namaImunisasi }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Deskripsi</label>
                            <textarea id="inputJenisUkbm" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi">{{ $data->deskripsi }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('imunisasi-wus.jenis') }}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Batal Menginputkan Data?',
                            text: "Semua perubahan tidak akan disimpan",
                            type: 'warning',
                            buttons:{
                                cancel: {
                                    visible: true,
                                    text : 'Lanjutkan Mengisi Data',
                                    className: 'btn btn-success',
                                },
                                confirm: {
                                    text: 'Iya',
                                    className : 'btn btn-secondary',
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