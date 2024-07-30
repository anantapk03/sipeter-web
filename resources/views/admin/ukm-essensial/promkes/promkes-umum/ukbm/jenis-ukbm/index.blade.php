@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Jenis UKBM</h3>
            <a class="btn btn-sm btn-success" href="{{ route('ukbm.jenis.create') }}"><i class="fas fa-plus" style="margin-right: 3%"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jenisUkbm }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('ukbm.jenis.edit', $item->id) }}"><i class="fas fa-edit" style="margin-right: 3%"></i>  Edit</a>
                                {{-- <a href="#" data-href="{{ route('ukbm.jenis.delete', $item->id) }}" class="btn btn-sm btn-danger" style="margin-right: 3%" id="deleteConfirmation{{ $item->id }}"><i class="fas fa-trash"></i> Hapus</a> --}}
                                {{-- JS DELETE CONFIRMATION --}}
                                {{-- <script>
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
                                </script> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('ukbm.data-ukbm.index') }}" class="btn btn-warning" style="margin-left: 1%">Kembali</a>
        </div>
    </div>
</div>
@endsection