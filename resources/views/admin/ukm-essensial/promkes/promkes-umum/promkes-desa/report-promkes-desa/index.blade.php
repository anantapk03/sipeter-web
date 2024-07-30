@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('program-kegiatan-promkes-desa-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card">
        <div class="card-header">
            <h3>Report Sub {{$data->namaKegiatan}} Periode {{$year}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table-month" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($monthInYearCondition as $monthNumber => $monthData)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$monthData['name']}}
                                </td>
                                <td>
                                    @if ($monthData['status'])
                                        <a href="{{route('pencatatan-program-kegiatan-promkes-desa-create', ["id"=>$data->id, "month"=>$monthNumber])}}" class="btn btn-sm btn-success">Buat Laporan</a>
                                    @else
                                        <a href="#" class="btn btn-sm btn-primary">Lihat Laporan</a>
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