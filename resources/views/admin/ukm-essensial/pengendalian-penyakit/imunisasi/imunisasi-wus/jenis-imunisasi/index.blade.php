@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('imunisasi-wus.index') }}" class="btn btn-danger mb-2"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Jenis Imunisasi Wanita Usia Subur</h3>
            <div>
                <a href="{{ route('imunisasi-wus.jenis.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaImunisasi }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                @if ( (bool) $item->isActive)
                                    <a href="{{ route('imunisasi-wus.jenis.status', $item->id) }}" class="badge badge-success"><i class="fas fa-toggle-on"></i>  Active</a>
                                @else
                                    <a href="{{ route('imunisasi-wus.jenis.status', $item->id) }}" class="badge badge-danger"><i class="fas fa-toggle-off"></i>  Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('imunisasi-wus.jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" data-href="{{ route('imunisasi-wus.jenis.delete', $item->id) }}" id="deleteConfirmation{{ $item->id }}" class="btn btn-sm btn-danger">Delete</a>
                                {{-- Delete Method --}}
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
                                {{-- End Delete Method --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
