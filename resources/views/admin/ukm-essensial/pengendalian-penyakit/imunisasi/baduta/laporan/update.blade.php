@extends('admin.layouts.admin')
@section('content')

<a href="{{route('laporan-imunisasi-baduta-index', ['id'=>$sasaran->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Tambah Laporan Imunisasi Baduta Desa {{$sasaran->desa->namaDesa}} Bulan {{\App\helpers\MonthHelper::getMonth($sasaran->bulan)}}</h3>
        </div>
    </div>
    <form action="{{route('laporan-imunisasi-baduta-update', ['id'=>$sasaran->id, 'idLaporan'=>$data->id])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="selectJenisImunisasi">Jenis Imunisasi</label>
                <select id="selectJenisImunisasi" type="text" name="idJenisImunisasi" class="form-control" required disabled>
                    <option value="{{$data->idJenisImunisasi}}">{{$data->jenisImunisasi->namaImunisasi}}</option>
                    @foreach ($imunisasi as $item)
                        <option value="{{$item->id}}">{{$item->namaImunisasi}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" id="catatanJumlahBaduta">
                <div class="col">
                    <div class="form-group">
                        <label for="jumlahBadutaLaki">Jumlah Baduta Laki-laki</label>
                        <input id="jumlahBadutaLaki" type="number" min="0" name="jumlah_laki" class="form-control" required placeholder="Jumlah baduta laki-laki..." value="{{$data->jumlah_laki}}">
                    </div>        
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="jumlahbadutaPerempuan">Jumlah Baduta Perempuan</label>
                        <input id="jumlahbadutaPerempuan" type="number" min="0" name="jumlah_perempuan" class="form-control" required placeholder="Jumlah baduta perempuan..." value="{{$data->jumlah_perempuan}}">
                    </div>       
                </div>
            </div>
            <div class="form-group">
                <label for="inputDeskripsiPencatatan">Deskripsi</label>
                <textarea id="inputDeskripsiPencatatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Pencatatan"> {{$data->deskripsi}} </textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Perbarui</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('laporan-imunisasi-baduta-index', ['id'=>$sasaran->id])}}">Kembali</a>
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
