@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('pencatatan-program-kegiatan-promkes-desa-index', ['id'=>$data->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    @if (!$status)
    <div class="alert alert-warning mb-3">
        <h4>
            <span class="badge badge-warning mr-3">
                <i class="flaticon-alarm-1" style="font-size: 24px;"></i>
            </span>
            Anda tidak diperkenankan mengirimkan laporan untuk saat ini
        </h4>
    </div>
    @endif
    @if ($status && $isReportDone->isEmpty())
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Semua data desa sudah dilaporkan
        </h4>
    </div>       
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Report Sub {{$data->namaKegiatan}} Periode {{$year}} Bulan {{$month}}</h3>
                @if ($status && !$isReportDone->isEmpty())
                <a href="{{route('pencatatan-program-kegiatan-promkes-desa-createReport', ['id'=>$data->id, 'month'=>$monthNumber, 'status'=>$status])}}" class="btn btn-primary">Tambah</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Desa</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Desa</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dataReport as $item)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$item->namaDesa}}
                                </td>
                                <td>
                                    {{$item->jumlah}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info mr-2 mt-2" data-target="#exampleModalCenter{{$item->idReport}}" data-toggle="modal"><i class="fas fa-eye"></i></a>
                                    {{-- Modal start --}}
                                    <div class="modal fade" id="exampleModalCenter{{$item->idReport}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLongTitle">Data {{$data->namaKegiatan}} </h3>
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
                                                                <th scope="col">Tempat Kegiatan</th>
                                                                <td>:</td>
                                                                <td> {{$item->namaDesa}} </td>
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
                                    {{-- Modal end --}}
                                    @if ($status)
                                    <a href="{{route('pencatatan-program-kegiatan-promkes-desa-editReport', ['id'=>$data->id, 'idReport'=>$item->idReport, 'month'=>$monthNumber, 'status'=>$status])}}" class="btn btn-sm btn-warning mr-2 mt-2"><i class="fas fa-edit"></i></a>
                                    <a id="deleteConfirmation{{$item->idReport}}" data-href="{{route('pencatatan-program-kegiatan-promkes-desa-deleteReport', ['idReport'=>$item->idReport])}}" data-name="Kegiatan di {{$item->namaDesa}}" class="btn btn-sm btn-danger mr-2 mt-2 mb-2"><i class="fas fa-trash"></i></a>
                                    {{-- Start delete confirmation --}}
                                    <script>
                                        $("#deleteConfirmation"+{{$item->idReport}}).click(function () {
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