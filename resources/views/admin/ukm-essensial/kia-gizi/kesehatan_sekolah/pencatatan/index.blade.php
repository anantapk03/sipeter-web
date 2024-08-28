@extends('admin.layouts.admin')
@section('content')

<a href="{{route('kegiatan-program-kia-gizi-UKS-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
@if ($kelasSiswa->isEmpty())
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Semua data kelas sudah dilaporkan
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
                    @if ($kelasSiswa->isNotEmpty())
                    <a class="dropdown-item" href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-create', ['id'=>$dataKegiatan->id])}}"><i class="fas fa-plus-circle"></i> Buat Laporan</a>
                    @endif
                    <a class="dropdown-item" href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-archieves', ['id'=>$dataKegiatan->id])}}"><i class="fas fa-archive"></i> Arsip Laporan</a>
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
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
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
                                {{$item->kelasSiswa->namaKelas}}
                            </td>
                            <td>
                                {{$item->jumlah}}
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-info"></i> Info</a>
                                <a href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-edit', ['id'=>$dataKegiatan->id, 'idPencatatan'=>$item->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-delete', ['id'=>$dataKegiatan->id, 'idPencatatan'=>$item->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection