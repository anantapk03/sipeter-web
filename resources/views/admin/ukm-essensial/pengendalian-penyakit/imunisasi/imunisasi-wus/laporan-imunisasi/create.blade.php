@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Pencatatan Imunisasi</h3>
        </div>
        <form action="{{ route('imunisasi-wus.laporan.post', ['idSasaran'=>$sasaran->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Nama Desa</label>
                            <input id="inputJenisUkbm" type="text" name="namaDesa" class="form-control" required value="{{ $sasaran->namaDesa }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jumlah Sasaran</label>
                            <input id="inputJenisUkbm" type="number" name="jumlahSasaran" class="form-control" required value="{{ $sasaran->jumlahSasaran }}" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jenis</label>
                            <select class="js-example-basic-single form-control" name="jenis" id="inputKegiatan">
                                <option value="#"><< Pilih Kegiatan >></option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaImunisasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Jumlah</label>
                            <input id="inputJenisUkbm" type="number" name="jumlah" class="form-control" required placeholder="Masukan Jumlah"></input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('imunisasi-wus.laporan.index', ['idSasaran'=>$sasaran->id]) }}">Kembali</a>
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