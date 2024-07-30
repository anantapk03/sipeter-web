@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Data UKBM</h3>
        </div>
        @foreach ($data as $item)
        @endforeach
        <form action="{{ route('ukbm.data-ukbm.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputJenisUkbm">Nama Desa</label>
                        <select id="exampleFormControlSelect1" name="namaDesa" class="form-control" required>
                            @foreach ($data as $item)
                                <option value="{{ $item->idDesa }}">{{ $item->namaDesa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputJenisUkbm">Jenis UKBM</label>
                        <select id="exampleFormControlSelect1" name="jenisUkbm" class="form-control" required>
                            @foreach ($data as $item)
                                <option value="{{ $item->idJenisUkbm }}">{{ $item->jenisUkbm }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputJenisUkbm">Nama UKBM</label>
                        <input id="inputJenisUkbm" type="text" name="namaUkbm" class="form-control" required value="{{ $item->namaUkbm }}">
                    </div>
                    <div class="col-md-12">
                        <label for="inputJenisUkbm">Alamat UKBM</label>
                        <textarea id="inputJenisUkbm" name="alamatUkbm" class="form-control" required>{{ $item->alamatUkbm }}</textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="inputJenisUkbm">Sumber Pembiayaan</label>
                        <input id="inputJenisUkbm" type="text" name="sumberPembiayaan" class="form-control" required value="{{ $item->sumberPembiayaan }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="kegiatan">Kegiatan UKBM</label>
                        @foreach (json_decode($item->kegiatanUkbm) as $kegiatan)
                            <div id="kegiatan-list">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control kegiatan-item" name="kegiatanUkbm[]" value="{{ $kegiatan }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger remove-item" type="button">&times;</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="button" id="add-kegiatan" class="btn btn-sm btn-info">Tambah Kegiatan</button>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputJenisUkbm">Jumlah Kader (Orang)</label>
                        <input id="inputJenisUkbm" type="number" name="jumlahKader" class="form-control" required value="{{ $item->jumlahKader }}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputJenisUkbm">Jumlah Kader yang Dilatih (Orang)</label>
                        <input id="inputJenisUkbm" type="number" name="jumlahKaderDilatih" class="form-control" required value="{{ $item->jumlahKaderDilatih }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('ukbm.data-ukbm.index') }}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Batal Mengubah Data?',
                            text: "Semua perubahan tidak akan disimpan",
                            type: 'warning',
                            buttons:{
                                cancel: {
                                    visible: true,
                                    text : 'Lanjutkan Mengisi Data',
                                    className: 'btn btn-success',
                                },
                                confirm: {
                                    text: 'Iya',
                                    className : 'btn btn-secondary',
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
    <script>
        document.getElementById('add-kegiatan').addEventListener('click', function () {
            const kegiatanList = document.getElementById('kegiatan-list');
            const newItem = document.createElement('div');
            newItem.className = 'input-group mb-2';
            newItem.innerHTML = `
                <input type="text" class="form-control kegiatan-item" name="kegiatanUkbm[]" placeholder="Masukan kegiatan" required>
                <div class="input-group-append">
                    <button class="btn btn-danger remove-item" type="button">&times;</button>
                </div>
            `;
            kegiatanList.appendChild(newItem);
        });
    
        document.getElementById('kegiatan-list').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-item')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection