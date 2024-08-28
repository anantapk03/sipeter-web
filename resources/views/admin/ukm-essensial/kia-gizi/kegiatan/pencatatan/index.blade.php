@extends('admin.layouts.admin')
@section('content')

<a href="{{route('kegiatan-program-kia-gizi-index', ['id'=>$dataProgram->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
@if ($desa->isEmpty())
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Semua data desa sudah dilaporkan
        </h4>
    </div>
@else
<div class="alert alert-warning">
    <h4>
        <span class="badge badge-warning mr-3">
            <i class="flaticon-alarm" style="font-size: 24px;"></i>
        </span>
        Anda masih diperkenankan membuat laporan di bulan {{$month}}
    </h4>
</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Pencatatan Kegiatan {{$dataKegiatan->namaKegiatan}} Bulan {{$month}}</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
            
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @if ($desa->isNotEmpty())
                    <a class="dropdown-item" href="{{route('pencatatan-kegiatan-program-kia-gizi-create', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id])}}"><i class="fas fa-plus-circle"></i> Buat Laporan</a>
                    @endif
                    <a class="dropdown-item" href="{{route('pencatatan-kegiatan-program-kia-gizi-archieve', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id])}}"><i class="fas fa-archive"></i> Arsip Laporan</a>
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
                    @foreach ($data as $item)
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
                                <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->idReport}}" data-toggle="modal"><i class="fas fa-eye"></i> Detail</a>
                                {{-- Modal start --}}
                                <div class="modal fade" id="exampleModalCenter{{$item->idReport}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Data {{$dataKegiatan->namaKegiatan}} </h3>
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
                                <a href="{{route('pencatatan-kegiatan-program-kia-gizi-edit', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id, 'idPencatatan'=>$item->idReport])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" id="deleteConfirmation{{$item->idReport}}" data-href="{{route('pencatatan-kegiatan-program-kia-gizi-destroy', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id, 'idPencatatan'=>$item->idReport])}}" data-name="Kegiatan di {{$item->namaDesa}}" class="btn btn-sm btn-danger mr-2 mt-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection