@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Pencatatan Data UKBM</h3>
        </div>
        <form action="{{ route('ukbm.pencatatan-ukbm.store', ['month' => $month, 'status' => $status]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="selectUkbm">Data UKBM</label>
                            <select class="js-example-basic-single form-control" name="dataUkbm" required>
                                <option value="">Pilih</option>
                                @foreach ($ukbm as $item)
                                    @if ($item->status == "active")
                                        <option value="{{ $item->id }}">{{ $item->namaUkbm }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('.js-example-basic-single').select2();
                                });
                            </script>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputDeskripsi">Deskripsi</label>
                            <textarea id="inputDeskripsi" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Keterangan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('ukbm.pencatatan-ukbm.index',['month' => $month, 'status' => $status]) }}">Kembali</a>
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