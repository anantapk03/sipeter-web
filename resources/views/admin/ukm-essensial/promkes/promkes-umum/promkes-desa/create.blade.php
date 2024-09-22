@extends('admin.layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Tambah data sub kegiatan program promosi kesehatan umum di desa/kelurahan</h3>
        </div>
        <form action="{{route('program-kegiatan-promkes-desa-store')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputNamaKegiatan">Nama Sub Kegiatan</label>
                    <input id="inputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required placeholder="Masukan Nama Sub Kegiatan">
                </div>
                <div class="form-group">
                    <label for="inputDeskripsiKegiatan">Deskripsi Sub Kegiatan</label>
                    <textarea id="inputDeskripsiKegiatan" type="text" name="deskripsiKegiatan" class="form-control" required placeholder="Masukan Deskripsi Sub Kegiatan"></textarea>
                </div>
                <div class="row" id="DataTargetKegiatan">
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetBulanan">Target Bulanan</label>
                            <input id="inputTargetBulanan" type="number" name="targetBulanan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama bulanan...">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetTriwulan">Target Triwulan</label>
                            <input id="inputTargetTriwulan" type="number" name="targetTriwulan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Triwulan...">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetSemester">Target Semester</label>
                            <input id="inputTargetSemester" type="number" name="targetSemester" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Semester...">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="inputTargetTahunan">Target Tahunan</label>
                            <input id="inputTargetTahunan" type="number" name="targetTahunan" class="form-control" required placeholder="Masukan Target Jumlah Kegiatan selama Tahunan...">
                        </div>        
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('program-kegiatan-promkes-desa-index')}}">Kembali</a>
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