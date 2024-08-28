@extends('admin.layouts.admin')
@section('content')

<a href="{{route('pencatatan-kegiatan-program-kia-gizi-index', ['id'=>$dataProgram->id, 'idKegiatan'=>$dataKegiatan->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>


<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Arsip Pencatatan Kegiatan {{$dataKegiatan->namaKegiatan}}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Desa</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
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
                                {{$item->tahun}}
                            </td>
                            <td>
                                {{App\Helpers\MonthHelper::getMonth($item->bulan)}}
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection