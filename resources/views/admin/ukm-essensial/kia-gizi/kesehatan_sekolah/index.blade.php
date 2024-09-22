@extends('admin.layouts.admin')
@section('content')

<a href="{{route('program-kia-gizi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Program Kesehatan Sekolah</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
            
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('kegiatan-program-kia-gizi-UKS-kelas-siswa-index')}}"><i class="fas fa-book"></i> Data Kelas</a>
                    <a class="dropdown-item" href="{{route('kegiatan-program-kia-gizi-UKS-create')}}"><i class="fas fa-plus-circle"></i> Tambah Kegiatan</a>
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
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Status</th>
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
                                {{$item->namaKegiatan}}
                            </td>
                            <td>
                                @if ($item->isActive)
                                <a href="{{route('kegiatan-program-kia-gizi-UKS-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>                                    
                                @else
                                <a href="{{route('kegiatan-program-kia-gizi-UKS-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>
                                @endif
                            </td>
                            <td>
                                @if (\App\Helpers\MonthHelper::checkClassInReport($item->id)->isNotEmpty())
                                <a href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$item->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-info"></i> Buat Laporan</a>
                                
                                @else
                                <a href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$item->id])}}" class="btn btn-sm btn-success"><i class="fas fa-info"></i> Laporan Lengkap</a>
                                @endif
                                <a href="{{route('kegiatan-program-kia-gizi-UKS-edit', ['id'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection