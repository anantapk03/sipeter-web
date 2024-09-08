@extends('admin.layouts.admin')
@section('content')
<a href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

<div class="card">
    <div class="card-header">
        <h3>Data Arsip Laporan Imunisasi Setiap Desa</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Desa</th>
                        <th>Jenis Imunisasi</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Desa</th>
                        <th>Jenis Imunisasi</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{ \App\Helpers\MonthHelper::getMonth($item->sasaranImunisasi->bulan) }}-{{$item->sasaranImunisasi->tahun}}
                            </td>
                            <td>
                                {{$item->sasaranImunisasi->desa->namaDesa}}
                            </td>
                            <td>
                                {{$item->jenisImunisasi->namaImunisasi}}
                            </td>
                            <td>
                                {{$item->jumlah_laki + $item->jumlah_perempuan}}
                            </td>
                            <td>
                                {{$item->deskripsi}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection