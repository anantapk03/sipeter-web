@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Tambah Data Sasaran Program Imunisasi Bayi {{$monthName}} {{$year}}</h3>
        </div>
    </div>
    <form action="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inpukNama">Desa / Kelurahan</label>
                <select type="text" name="idDesa" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($desa as $item)
                        <option value="{{$item->id}}">{{$item->namaDesa}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" id="targetBayi">
                <div class="col">
                    <div class="form-group">
                        <label for="inputTargetBayiLaki">Target Bayi Laki</label>
                        <input id="inputTargetBayiLaki" type="number" name="jumlah_sasaran_bayi_laki" class="form-control" required placeholder="Jumlah sasaran bayi laki-laki">
                    </div>        
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="inputTargetBayiPerempuan">Target Bayi Perempuan</label>
                        <input id="inputTargetBayiPerempuan" type="number" name="jumlah_sasaran_bayi_perempuan" class="form-control" required placeholder="Jumlah sasaran bayi Perempuan-Perempuan">
                    </div>        
                </div>
            </div>
            <div class="row" id="targetSurvivingInfant">
                <div class="col">
                    <div class="form-group">
                        <label for="jumlahSurvivingInfantLaki">Target Surviving Infant Laki</label>
                        <input id="jumlahSurvivingInfantLaki" type="number" name="jumlah_surviving_infant_laki" class="form-control" required placeholder="Jumlah surviving infant laki-laki">
                    </div>        
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="jumlahSurvivingInfantPerempuan">Target Surviving Infant Perempuan</label>
                        <input id="jumlahSurvivingInfantPerempuan" type="number" name="jumlah_surviving_infant_perempuan" class="form-control" required placeholder="Jumlah surviving infant perempuan">
                    </div>        
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')}}">Kembali</a>
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
