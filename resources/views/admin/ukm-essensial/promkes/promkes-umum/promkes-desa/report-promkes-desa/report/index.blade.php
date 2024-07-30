@extends('admin.layouts.admin')
@section('content')
<a href="{{route('pencatatan-program-kegiatan-promkes-desa-index', ['id'=>$data->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Report Sub {{$data->namaKegiatan}} Periode {{$year}} Bulan {{$month}}</h3>
            <a href="{{route('pencatatan-program-kegiatan-promkes-desa-createReport', ['id'=>$data->id, 'month'=>$monthNumber])}}" class="btn btn-primary">Tambah</a>
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
                            action
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection