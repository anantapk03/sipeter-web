@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Data Sasaran Imunisasi Wanita Usia Subur</h3>
        </div>
        @foreach ($data as $item)
        @endforeach
        <form action="{{ route('imunisasi-wus.sasaran.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputJenisUkbm">Nama Desa</label>
                            <select id="exampleFormControlSelect1" name="desa" class="form-control" disabled>
                                @foreach ($data as $item)
                                    <option value="{{ $item->idDesa }}">{{ $item->namaDesa }}</option>
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
                            <input id="inputJenisUkbm" type="number" name="jumlah" class="form-control" required value="{{ $item->jumlahSasaran }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('imunisasi-wus.sasaran') }}">Kembali</a>
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