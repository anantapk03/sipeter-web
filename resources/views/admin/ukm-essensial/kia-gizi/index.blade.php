@extends('admin.layouts.admin')
@section('content')

<a href="{{route('ukm-essensial.index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Program KIA & Gizi</h3>
            <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="{{route('program-kia-gizi-create')}}" class="dropdown-item"><i class="flaticon-plus"></i> Buat Progam</a>
                    <a href="{{route('program-kia-gizi-index-statistics')}}" class="dropdown-item"><i class="flaticon-analytics"></i> Statistik Data</a>
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
                        <th>Nama Program</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                       <td>1</td>
                       <td> Program Usaha Kegiatan Sekolah </td> 
                       <td> <a href="#" class="btn btn-sm btn-success disabled">Active</a></td>
                       <td>
                            <a href="{{route('kegiatan-program-kia-gizi-UKS-index')}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                            <a href="#" class="btn btn-sm btn-warning disabled"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            {{$loop->iteration+1}}
                        </td>
                        <td>
                            {{$item->namaProgram}}
                        </td>
                        <td>
                            @if ($item->isActive)
                            <a href="{{route('program-kia-gizi-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                            @else
                            <a href="{{route('program-kia-gizi-updateStatus', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('kegiatan-program-kia-gizi-index', ['id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Info</a>
                            <a href="{{route('program-kia-gizi-edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection