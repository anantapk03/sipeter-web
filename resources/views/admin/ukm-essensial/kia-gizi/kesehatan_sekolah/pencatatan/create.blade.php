@extends('admin.layouts.admin')
@section('content')
<div class="card">
    @if ($dataKelasSiswa->isEmpty())
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Semua data sudah dilaporkan
        </h4>
    </div>
    @endif
    <div class="card-header">
        <h3>Tambah data laporan {{$dataKegiatan->namaKegiatan}} Bulan {{$monthName}}</h3>
    </div>
    <form action="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-store', ['id'=>$dataKegiatan->id])}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputNamaKegiatan">Bulan</label>
                <input id="InputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required value="{{$monthName}}" disabled>
            </div>
            <div class="form-group">
                <label for="InputNamaKegiatan">Nama Kegiatan</label>
                <input id="InputNamaKegiatan" type="text" name="namaKegiatan" class="form-control" required value="{{$dataKegiatan->namaKegiatan}}" disabled>
            </div>
            <div class="form-group">
                <label for="inpukNama">Kelas Siswa</label>
                <select type="text" name="idKelasSiswa" class="form-control" required>
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($dataKelasSiswa as $item)
                        <option value="{{$item->id}}">{{$item->namaKelas}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputJumlah">jumlah</label>
                <input id="inputJumlah" type="number" name="jumlah" class="form-control" required placeholder="Masukan jumlah pelaksanaan kegiatan...">
            </div>
            <div class="form-group">
                <label for="inputDeskripsiPencatatan">Deskripsi</label>
                <textarea id="inputDeskripsiPencatatan" type="text" name="deskripsi" class="form-control" required placeholder="Masukan Deskripsi Pencatatan"></textarea>
            </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-success" type="submit">Simpan</button>
            <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$dataKegiatan->id])}}">Kembali</a>
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