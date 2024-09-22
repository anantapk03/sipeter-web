@extends('admin.layouts.admin')
@section('content')

<a href="{{route('program-p2-index', ['id'=>$program->idCategory])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

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
            <h3>Laporan Kegiatan Program Pengendalian Penyakit {{$program->categoryP2->namaCategory}} {{$program->namaProgram}} Bulan {{$monthName}} {{$year}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('kegiatan-p2-index', ['id'=>$program->id])}}"><i class="fas fa-book"></i> Kegiatan Program</a>
                    <a class="dropdown-item" href="{{route('laporan-kegiatan-program-p2-create', ['id'=>$program->id])}}"><i class="fas fa-plus-circle"></i> Tambah Laporan</a>
                    <a class="dropdown-item" href="{{route('laporan-kegiatan-program-p2-history', ['id'=>$program->id])}}"><i class="flaticon-archive"></i> Riwayat Laporan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->kegiatanProgramPengendalianPenyakit->namaKegiatan}}
                            </td>
                            <td>
                                {{$item->jumlah}}
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"><i class="fas fa-eye"></i> Detail</a>
                                {{-- Modal start --}}
                                <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Laporan Kegiatan Program Pengendalian Penyakit {{$program->namaProgram}} {{$item->kegiatanProgramPengendalianPenyakit->namaKegiatan}} </h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mt-3">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col">Deskripsi</th>
                                                            <td>:</td>
                                                            <td>{{ $item->deskripsi}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Total Jumlah</th>
                                                            <td>:</td>
                                                            <td>{{$item->jumlah}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>s
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{route('laporan-kegiatan-program-p2-edit', ['id'=>$program->id, 'idPencatatan'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" id="deleteConfirmation{{$item->id}}" data-href="{{route('laporan-kegiatan-program-p2-destroy', ['id'=>$program->id, 'idPencatatan'=>$item->id])}}" data-name="Laporan Pencatatan Kegiatan {{$item->kegiatanProgramPengendalianPenyakit->namaKegiatan}} di bulan {{$monthName}} {{$year}}" class="btn btn-sm btn-danger mr-2 mt-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
                                {{-- Start delete confirmation --}}
                                <script>
                                    $("#deleteConfirmation"+{{$item->id}}).click(function () {
                                        swal({
                                            title: 'Peringatan!',
                                            text: "Data "+$(this).data('name')+" Akan Dihapus",
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
                                {{-- End of delete confirmation --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
