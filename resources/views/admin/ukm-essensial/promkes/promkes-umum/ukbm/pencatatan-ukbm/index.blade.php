@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('ukbm.pencatatan-ukbm.report') }}" class="btn btn-danger mb-3">Kembali</a>
@if (!$status)
    <div class="alert alert-warning mb-3">
        <h4>
            <span class="badge badge-warning mr-3">
                <i class="flaticon-alarm-1" style="font-size: 24px;"></i>
            </span>
            Anda tidak diperkenankan mengirimkan laporan untuk saat ini
        </h4>
    </div>
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3> Pencatatan Data UKBM Bulan {{ $monthName }}</h3>
            @if ($status)
                <a class="btn btn-sm btn-success" href="{{ route('ukbm.pencatatan-ukbm.create', ['month'=>$month, 'status'=>$status]) }}"><i class="fas fa-plus" style="margin-right: 3%"></i>  Tambah</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables3" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ukbm</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaUkbm }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('ukbm.pencatatan-ukbm.edit', ['month' => $month, 'status' => $status, 'id' => $item->id]) }}"><i class="fas fa-edit" style="margin-right: 3%"></i>  Edit</a>
                                    <a class="btn btn-sm btn-danger" data-href="{{  route('ukbm.pencatatan-ukbm.delete', ['month' => $month, 'status' => $status, 'id' => $item->id]) }}" id="deleteConfirmation{{ $item->id }}" href="javascript:void(0)" ><i class="fas fa-trash"></i>  Hapus</a>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection