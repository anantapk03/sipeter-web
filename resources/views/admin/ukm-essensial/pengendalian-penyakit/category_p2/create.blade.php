@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Kategori Program Pengendalian Penyakit</h3>
        </div>
        <form action="{{route('category-p2-store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaCategory">Nama Category</label>
                    <input id="inputNamaCategory" type="text" name="namaCategory" class="form-control" required placeholder="Masukan Nama Category">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiImunisasi">Deskripsi</label>
                    <textarea id="inputDeskripsiImunisasi" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('category-p2-index')}}">Kembali</a>
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