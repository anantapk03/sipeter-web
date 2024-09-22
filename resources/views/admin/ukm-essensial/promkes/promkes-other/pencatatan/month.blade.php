@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('kegiatan-program-divisi-promkes-index', ['id'=>$dataProgram->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    @if ($isReportThisMonthDone)
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Anda sudah melaporkan untuk bulan ini
        </h4>
    </div> 
    @else
    <div class="alert alert-danger">
        <h4>
            <span class="badge badge-danger mr-3">
                <i class="flaticon-exclamation" style="font-size: 24px;"></i>
            </span>
            Anda belum melaporkan data untuk bulan {{\App\Helpers\MonthHelper::getMonth($month)}}
        </h4>
    </div> 
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Laporan Tahun {{$year}} - Kegiatan {{$dataKegiatan->namaKegiatan}} - Program {{$dataProgram->namaProgram}}</h3>
                @if (!$isReportThisMonthDone)
                <a href="{{route('report-create-activity-promkes-month', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id])}}" class="btn btn-primary">Tambah</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dataPencatatan as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{\App\Helpers\MonthHelper::getMonth($item->bulan)}}
                                </td>
                                <td>
                                    {{$item->jumlah}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"><i class="fas fa-info"></i> Info</a>
                                    {{-- Modal start --}}
                                    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLongTitle">Data Kegiatan {{$dataKegiatan->namaKegiatan}} </h3>
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
                                                                <th scope="col">Nama Program</th>
                                                                <td>:</td>
                                                                <td> {{$dataProgram->namaProgram}} </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Jumlah</th>
                                                                <td>:</td>
                                                                <td> {{$item->jumlah}} </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->bulan == $month)
                                    <a href="{{route('report-edit-activity-promkes-month', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id, 'idPencatatan'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" id="deleteConfirmation{{$item->id}}" data-name="{{"bulan ".\App\Helpers\MonthHelper::getMonth($item->bulan)}}" data-href="{{route('report-destroy-activity-promkes-month', ['id'=>$dataProgram->id, 
                                    'idKegiatan'=>$dataKegiatan->id, 
                                    'idPencatatan'=>$item->id
                                    ])}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    {{-- Delete Confirmation --}}
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
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection