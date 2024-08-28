@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data Kegiatan Kesehatan Lingkungan Bulan {{ $currentMonthName }}</h3>
        </div>
        <form action="{{ route('kesling.kegiatan.report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    Isi dengan angka nol '0' jika tidak terdapat kategori target tersebut!
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Nama Kegiatan</label>
                            <select class="js-example-basic-single form-control" name="kegiatan" id="inputKegiatan">
                                <option value="#"><< Pilih Kegiatan >></option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jumlah</label>
                            <input id="inputJenisUkbm" type="number" name="jumlah" class="form-control" required placeholder="Masukan Jumlah">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Deskripsi</label>
                            <textarea id="inputJenisUkbm" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('kesling.kegiatan.report') }}">Kembali</a>
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