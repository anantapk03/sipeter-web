@extends('admin.layouts.admin')
@section('content')

<a href="{{route('sasaran-imunisasi-baduta-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Tambah Data Sasaran Program Imunisasi Baduta {{$monthName}} {{$year}}</h3>
        </div>
    </div>
    <form action="{{route('sasaran-imunisasi-baduta-update', ['id'=>$data->id])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inpukNama">Desa / Kelurahan</label>
                <select type="text" name="idDesa" class="form-control" required>
                    <option value="{{$data->idDesa}}">{{$data->desa->namaDesa}}</option>
                    @foreach ($desa as $item)
                        <option value="{{$item->id}}">{{$item->namaDesa}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" id="targetBaduta">
                <div class="col">
                    <div class="form-group">
                        <label for="inputTargetBayiLaki">Target Bayi Laki</label>
                        <input id="inputTargetBayiLaki" type="number" min="0" name="sasaran_laki" class="form-control" required placeholder="Jumlah sasaran baduta laki-laki" value="{{$data->sasaran_laki}}">
                    </div>        
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="inputTargetBayiPerempuan">Target Bayi Perempuan</label>
                        <input id="inputTargetBayiPerempuan" type="number" min="0" name="sasaran_perempuan" class="form-control" required placeholder="Jumlah sasaran baduta Perempuan-Perempuan" value="{{$data->sasaran_perempuan}}">
                    </div>        
                </div>
            </div>
            <div class="form-group">
                <label for="inputDeskripsiPencatatan">Deskripsi</label>
                <textarea id="inputDeskripsiPencatatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Pencatatan"> {{$data->deskripsi}} </textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('sasaran-imunisasi-baduta-index')}}">Kembali</a>
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
