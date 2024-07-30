@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah data laporan sub kegiatan {{$subKegiatan->namaKegiatan}}</h3>
    </div>
    <form action="{{route('pencatatan-program-kegiatan-promkes-desa-storeReport', ['id'=>$subKegiatan->id, 'month'=>$month])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputNamaKegiatan">Bulan</label>
                <input id="InputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required value="{{$monthNameIdn}}" disabled>
            </div>
            <div class="form-group">
                <label for="InputNamaKegiatan">Nama Kegiatan</label>
                <input id="InputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required value="{{$subKegiatan->namaKegiatan}}" disabled>
            </div>
            <div class="form-group">
                <label for="inpukNama">Desa / Kelurahan</label>
                <select type="text" name="idDesa" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($desa as $item)
                        <option value="{{$item->id}}">{{$item->namaDesa}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputJumlah">jumlah</label>
                <input id="inputJumlah" type="number" name="jumlah" class="form-control" required placeholder="Masukan jumlah pelaksanaan kegiatan...">
            </div>


        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('pencatatan-program-kegiatan-promkes-desa-create', ['id'=>$subKegiatan->id, 'month'=>$month])}}">Kembali</a>
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