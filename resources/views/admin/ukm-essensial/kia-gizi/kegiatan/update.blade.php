@extends('admin.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit data Kegiatan {{$dataProgram->namaProgram}}</h3>
        </div>
        <form action="{{route('kegiatan-program-kia-gizi-update', ['id'=>$dataProgram->id, 'idKegiatan'=>$data->id])}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Kegiatan</label>
                    <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Kegiatan" value="{{$data->namaKegiatan}}">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi Kegiatan</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Kegiatan">{{$data->deskripsi}}</textarea>
                </div>
                <div class="row" id="targetByDesa">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetBulanan">Target JumlahSetiapDesa</label>
                            <input id="inputTargetJumlahSetiapDesa" type="number" name="targetJumlahSetiapDesa" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama JumlahSetiapDesa..." value="{{$data->targetJumlahSetiapDesa}}">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetJumlahDesaMelaksanakan">Target Jumlah Desa Melaksanakan</label>
                            <input id="inputTargetJumlahDesaMelaksanakan" type="number" name="targetJumlahDesaMelaksanakan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama JumlahDesaMelaksanakan..." value="{{$data->targetJumlahDesaMelaksanakan}}">
                        </div>        
                    </div>
                </div>
                <div class="row" id="targetByTime">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetBulanan">Target Bulanan</label>
                            <input id="inputTargetBulanan" type="number" name="targetBulanan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama bulanan..." value="{{$data->targetBulanan}}">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetTriwulan">Target Triwulan</label>
                            <input id="inputTargetTriwulan" type="number" name="targetTriwulan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Triwulan..." value="{{$data->targetTriwulan}}">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetSemester">Target Semester</label>
                            <input id="inputTargetSemester" type="number" name="targetSemester" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Semester..." value="{{$data->targetSemester}}">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetTahunan">Target Tahunan</label>
                            <input id="inputTargetTahunan" type="number" name="targetTahunan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Tahunan..." value="{{$data->targetTahunan}}">
                        </div>        
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('kegiatan-program-kia-gizi-index', ['id'=>$dataProgram->id])}}">Kembali</a>
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