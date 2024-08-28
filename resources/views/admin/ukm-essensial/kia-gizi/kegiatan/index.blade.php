@extends('admin.layouts.admin')
@section('content')

<a href="{{route('program-kia-gizi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data {{$dataProgram->namaProgram}}</h3>
            <a href="{{route('kegiatan-program-kia-gizi-create', ['id'=>$dataProgram->id])}}" class="btn btn-primary">Tambah</a>
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
                                    <a href="{{route('kegiatan-program-kia-gizi-updateStatus', ['idKegiatan'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                                @else
                                    <a href="{{route('kegiatan-program-kia-gizi-updateStatus', ['idKegiatan'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>
                                @endif
                            </td>
                            <td>
                                @if (\App\Helpers\MonthHelper::checkDesaInReport($item->id)->isNotEmpty())
                                <a href="{{route('pencatatan-kegiatan-program-kia-gizi-index', ['id'=>$dataProgram->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-info"></i> Periksa</a>
                                @else
                                <a href="{{route('pencatatan-kegiatan-program-kia-gizi-index', ['id'=>$dataProgram->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Lihat</a>
                                @endif
                                <a href="{{route('kegiatan-program-kia-gizi-edit', ['id'=>$dataProgram->id, 'idKegiatan'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection