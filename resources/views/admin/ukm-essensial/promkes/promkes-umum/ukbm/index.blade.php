@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Jenis UKBM</h3>
            <a class="btn btn-sm btn-success" href="{{ route('ukbm.jenis.create') }}"><i class="fas fa-plus" style="margin-right: 3%"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jenisUkbm }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('ukbm.jenis.edit', $item->id) }}"><i class="fas fa-edit" style="margin-right: 3%"></i>  Edit</a>
                                <a href="#" data-href="{{ route('ukbm.jenis.delete', $item->id) }}" class="btn btn-sm btn-danger" style="margin-right: 3%" id="deleteConfirmation{{ $item->id }}"><i class="fas fa-trash"></i> Hapus</a>
                                {{-- JS DELETE CONFIRMATION --}}
                                <script>
                                    $("#deleteConfirmation"+{{$item->id}}).click(function () {
                                        swal({
                                            title: 'Peringatan!',
                                            text: "Kamu yakin mau hapus?",
                                            type: 'warning',
                                            buttons:{
                                                confirm: {
                                                    text: 'Hapus Data',
                                                    className : 'btn btn-success',
                                                },
                                                cancel: {
                                                    visible: true,
                                                    text : 'Batalkan',
                                                    className: 'btn btn-danger',
                                                }
                                            }
                                        }).then((willConfirm) => {
                                            if (willConfirm) {
                                                window.location.href = $(this).data('href');
                                            } 
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('promkes.show.activity') }}" class="btn btn-warning" style="margin-left: 1%">Kembali</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data UKBM</h3>
            <a class="btn btn-sm btn-success" href="{{ route('ukbm.data-ukbm.create') }}"><i class="fas fa-plus" style="margin-right: 3%"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables2" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Desa</th>
                        <th>Jenis UKBM</th>
                        <th>Nama UKBM</th>
                        {{-- <th>Alamat UKBM</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Desa</th>
                        <th>Jenis UKBM</th>
                        <th>Nama UKBM</th>
                        {{-- <th>Alamat UKBM</th> --}}
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($dataUkbm as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaDesa }}</td>
                            <td>{{ $item->jenisUkbm }}</td>
                            <td>{{ $item->namaUkbm }}</td>
                            {{-- <td>{{ $item->alamatUkbm }}</td> --}}
                            <td>
                                <div class="m-2">
                                    <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"> <i class="fas fa-info"></i> Info</a>
                                    <!-- Modal Info -->
                                    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Data UKBM</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mt-3">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <td>:</td>
                                                            <td>{{ $loop->iteration }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Nama Desa</th>
                                                            <td>:</td>
                                                            <td> {{$item->namaDesa}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jenis UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->jenisUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Nama UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->namaUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Alamat UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->alamatUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Sumber Pembiayaan</th>
                                                            <td>:</td>
                                                            <td> {{$item->sumberPembiayaan}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Kegiatan UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->kegiatanUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jumlah Kader</th>
                                                            <td>:</td>
                                                            <td> {{$item->jumlahKader}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jumlah Kader yang dilatih</th>
                                                            <td>:</td>
                                                            <td> {{$item->jumlahKaderDilatih}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="#" class="btn btn-warning">Edit Data</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Info -->

                                    <a class="btn btn-sm btn-warning" href="#"><i class="fas fa-edit"></i>  Edit</a>
                                    <a class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash"></i>  Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3> Pencatatan Data UKBM</h3>
            <a class="btn btn-sm btn-success" href="#"><i class="fas fa-plus" style="margin-right: 3%"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables3" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kegiatan Promosi Kesehatan di Desa</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="#"><i class="fas fa-edit" style="margin-right: 3%"></i>  Edit</a>
                            <a class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash" style="margin-right: 3%"></i>  Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
