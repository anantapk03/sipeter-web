@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('kesling.kegiatan.index') }}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
@if ($month != $monthNumber)
    <div class="alert alert-warning mb-3">
        <h4>
            <span class="badge badge-warning mr-3">
                <i class="flaticon-alarm-1" style="font-size: 24px;"></i>
            </span>
            Anda tidak diperkenankan mengirimkan laporan untuk untuk bulan ini
        </h4>
    </div>
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Pencatatan Kegiatan Kesehatan Lingkungan</h3>
            @if ($month != $monthNumber)
                <button disabled class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</button>
            @else
                <a href="{{ route('kesling.kegiatan.report.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>
            @endif
        </div>
        <form action="{{ route('kesling.kegiatan.report') }}" method="GET">
            <div class="d-flex justify-content-between col-md-4">
                <label for="inputJenisUkbm" class="mr-1">Bulan</label>
                    <select id="filterBulan" name="bulan" class="js-example-basic-single form-control mr-2" required>
                        @if ($month != $monthNumber)
                            <option value="{{ $monthNumber }}" style="display: none">{{ $monthName }}</option>
                        @endif
                        <option value="1" {{ $month == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ $month == 2 ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ $month == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ $month == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ $month == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ $month == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ $month == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ $month == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ $month == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $month == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ $month == 11 ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $month == 12 ? 'selected' : '' }}>Desember</option>
                    </select>                
                    <script>
                        $(document).ready(function() {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->jumlah }} Buah</td>
                            <td>
                                @if ($month == $monthNumber)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <style>
                                        .dropdown-toggle::after{
                                            display: none;
                                        }
                                    </style>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item">
                                            <a href="{{ route('kesling.kegiatan.report.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                                        </div>
                                        <div class="dropdown-item">
                                            <a href="javascript:void(0)" id="deleteConfirmation{{ $item->id }}" data-href="{{ route('kesling.kegiatan.report.delete', $item->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            {{-- JS DELETE CONFIRMATION --}}                                
                                            <script>
                                                $("#deleteConfirmation"+{{$item->id}}).click(function () {
                                                    swal({
                                                        title: 'Peringatan!',
                                                        text: "Kamu yakin mau hapus?",
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
                                        </div>
                                    </div>
                                </div>
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
