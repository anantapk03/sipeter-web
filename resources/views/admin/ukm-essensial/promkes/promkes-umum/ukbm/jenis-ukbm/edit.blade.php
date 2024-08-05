@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Ubah Data Jenis UKBM</h3>
        </div>
        <form action="{{ route('ukbm.jenis.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    Isi dengan angka nol '0' jika tidak terdapat kategori target tersebut!
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jenis UKBM</label>
                            <input id="inputJenisUkbm" type="text" name="jenisUkbm" class="form-control" required value="{{ $data->jenisUkbm }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Bulanan</label>
                            <input id="inputJenisUkbm" type="number" name="bulanan" class="form-control" required  value="{{ $data->bulanan }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Triwulan</label>
                            <input id="inputJenisUkbm" type="number" name="triwulan" class="form-control" required  value="{{ $data->triwulan }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Semester</label>
                            <input id="inputJenisUkbm" type="number" name="semester" class="form-control" required  value="{{ $data->semester }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Tahunan</label>
                            <input id="inputJenisUkbm" type="number" name="tahunan" class="form-control" required value="{{ $data->tahunan }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('ukbm.jenis.index') }}">Kembali</a>
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