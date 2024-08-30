@extends('admin.layouts.admin')
@section('content')

<a href="{{route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$dataKegiatan->id])}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Arsip Data Pencatatan Kegiatan {{$dataKegiatan->namaKegiatan}}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Kelas</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
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
                            {{\App\Helpers\MonthHelper::getMonth($item->bulan)}}
                        </td>
                        <td>
                            {{$item->tahun}}
                        </td>
                        <td>
                            {{$item->kelasSiswa->namaKelas}}
                        </td>
                        <td>
                            {{$item->jumlah}}
                        </td>
                        <td>
                            action
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection