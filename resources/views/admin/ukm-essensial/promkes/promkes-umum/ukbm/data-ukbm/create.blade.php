@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Data UKBM</h3>
        </div>
        <form action="{{ route('ukbm.data-ukbm.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="alert alert-warning mb-3" role="alert">
                    Jika tidak ada pilihan <b>Desa</b> dan <b>Jenis UKBM</b> bisa anda tambah dalam menu <b><a href="{{ route('desa.create') }}">Desa</a></b> dan <b><a href="{{ route('ukbm.jenis.create') }}">Jenis UKBM</a></b>!
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputJenisUkbm">Nama Desa</label>
                        <select id="namaDesa" name="namaDesa" class="js-example-responsive form-control" style="height: 40px" required>
                            <option value="#"><< Pilih >></option>
                            @foreach ($dataDesa as $item)
                                <option value="{{ $item->id }}">{{ $item->namaDesa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputJenisUkbm">Jenis UKBM</label>
                        <select id="jenisUkbm" name="jenisUkbm" style="height: 40px" class="js-example-responsive form-control" required>
                            <option value="#"><< Pilih >></option>
                            @foreach ($dataJenisUkbm as $item)
                                <option value="{{ $item->id }}">{{ $item->jenisUkbm }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputJenisUkbm">Nama UKBM</label>
                        <input id="inputJenisUkbm" type="text" name="namaUkbm" class="form-control" required placeholder="Masukan Nama UKBM">
                    </div>
                    <div class="col-md-12">
                        <label for="inputJenisUkbm">Alamat UKBM</label>
                        <textarea id="inputJenisUkbm" name="alamatUkbm" class="form-control" required placeholder="Masukan Alamat UKBM"></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="inputJenisUkbm">Sumber Pembiayaan</label>
                        <input id="inputJenisUkbm" type="text" name="sumberPembiayaan" class="form-control" required placeholder="Masukan Sumber Pembiayaan">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="kegiatan">Kegiatan UKBM</label>
                        <div id="kegiatan-list">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control kegiatan-item" name="kegiatan[]" placeholder="Masukan Kegiatan" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-item" type="button">&times;</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-kegiatan" class="btn btn-sm btn-info">Tambah Kegiatan</button>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputJenisUkbm">Jumlah Kader (Orang)</label>
                        <input id="inputJenisUkbm" type="number" name="jumlahKader" class="form-control" required placeholder="Masukan Jumlah Kader">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="inputJenisUkbm">Jumlah Kader yang Dilatih (Orang)</label>
                        <input id="inputJenisUkbm" type="number" name="jumlahKaderDilatih" class="form-control" required placeholder="Masukan Kumlah Kader yang dilatih">
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('.js-example-responsive').select2({
                            height: '40px',
                        });
                    });
                </script>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="#" class="btn btn-danger" id="backConfirmation" data-href="{{ route('ukbm.data-ukbm.index') }}">Kembali</a>
                <script>
                    $("#backConfirmation").click(function () {
                        swal({
                            title: 'Batal Menginputkan Data?',
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
                <input type="text" class="form-control kegiatan-item" name="kegiatan[]" placeholder="Masukan kegiatan" required>
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