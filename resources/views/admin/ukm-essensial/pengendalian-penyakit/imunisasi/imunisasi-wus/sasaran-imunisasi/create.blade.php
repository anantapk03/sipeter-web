@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data Sasaran Imunisasi Wanita Usia Subur</h3>
        </div>
        <form action="{{ route('imunisasi-wus.sasaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Nama Desa</label>
                            <select class="js-example-basic-single form-control" name="desa" id="inputKegiatan">
                                <option value="#">--- Pilih Desa ---</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaDesa }}</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('.js-example-basic-single').select2({
                                        height: '40px',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jumlah Sasaran</label>
                            <input id="inputJenisUkbm" type="number" name="jumlah" class="form-control" required placeholder="Masukan Jumlah">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('imunisasi-wus.index') }}">Kembali</a>
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