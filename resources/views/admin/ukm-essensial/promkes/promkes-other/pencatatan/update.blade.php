@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah data pencatatan kegiatan program {{$dataProgram->namaProgram}}</h3>
    </div>
    <form action="{{route('report-update-activity-promkes-month', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id, 'idPencatatan'=>$dataPencatatan->id])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputNamaKegiatan">Bulan</label>
                <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Kegiatan" value="{{\App\Helpers\MonthHelper::getMonth($dataPencatatan->bulan)}}" disabled>
            </div>
            <div class="form-group">
                <label for="inputNamaKegiatan">Nama Kegiatan</label>
                <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Kegiatan" value="{{$dataKegiatan->namaKegiatan}}" disabled>
            </div>
            <div class="form-group">
                <label for="inputDeskripsiKegiatan">Deskripsi</label>
                <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Pencatatan">{{$dataPencatatan->deskripsi}}</textarea>
            </div>
            <div class="form-group">
                <label for="inputTargetBulanan">Jumlah</label>
                <input id="inputTargetBulanan" type="number" name="jumlah" class="form-control" required placeholder="Masukan Jumlah Kegiatan di bulan ini..." value="{{$dataPencatatan->jumlah}}">
            </div>  
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('report-activity-promkes-month', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id])}}">Kembali</a>
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