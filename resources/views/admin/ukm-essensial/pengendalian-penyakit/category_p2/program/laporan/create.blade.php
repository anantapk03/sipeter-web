@extends('admin.layouts.admin')
@section('content')
@if ($isReportDone->isEmpty())
<div class="alert alert-success">
    <h4>
        <span class="badge badge-success mr-3">
            <i class="flaticon-success" style="font-size: 24px;"></i>
        </span>
        Seluruh Kegiatan Program Telah Berhasil Dilaporkan
    </h4>
</div>       
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Tambah Data Pencatatan Kegiatan Penyakit {{$program->namaProgram}} {{$monthName}} {{$year}}</h3>
        </div>
    </div>
    <form action="{{route('laporan-kegiatan-program-p2-store', ['id'=>$program->id])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inpukNama">Daftar Kegiatan</label>
                <select type="text" name="idKegiatan" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($kegiatan as $item)
                        <option value="{{$item->id}}">{{$item->namaKegiatan}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputJumlah">Jumlah</label>
                <input id="inputJumlah" type="number" min="0" name="jumlah" class="form-control" required placeholder="Masukan jumlah terlaksananya kegiatan">
            </div>  
            <div class="form-group">
                <label for="inputDeskripsiPencatatan">Deskripsi</label>
                <textarea id="inputDeskripsiPencatatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Pencatatan"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('laporan-kegiatan-program-p2', ['id'=>$program->id])}}">Kembali</a>
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
