@extends('admin.layouts.admin')
@section('content')
<a href="{{route('ukm-essensial.index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Kegiatan Kesehatan Lingkungan</h3>
            <div class="dropdown show" style="margin-left: 55%">
                <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('kesling.kegiatan.report') }}"><i class="fas fa-book"></i> Pencatatan</a>
                    <a class="dropdown-item" href="{{ route('kesling.index-statistic') }}"><i class="fas fa-chart-bar"></i> Statistic</a>
                </div>
            </div>
            <a href="{{ route('kesling.kegiatan.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                @if ($item->status == 'active')
                                    <a href="{{ route('kesling.kegiatan.updateStatus', $item->id) }}" class="badge badge-success" name="btnActive"><i class="fas fa-toggle-on"></i>  Active</a>
                                    @method('POST')
                                @else
                                    <a href="{{ route('kesling.kegiatan.updateStatus', $item->id) }}" class="badge badge-danger" name="btnInactive"><i class="fas fa-toggle-off"></i>  Inactive</a>
                                @endif
                            </td>
                            <td>
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
                                            <a href="{{ route('kesling.kegiatan.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                                        </div>
                                        <div class="dropdown-item">
                                            <a href="#" class="btn btn-sm btn-danger" id="deleteConfirmation{{ $item->id }}" data-href="{{ route('kesling.kegiatan.delete', $item->id) }}"><i class="fas fa-trash"></i> Hapus</a>
                                        </div>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
