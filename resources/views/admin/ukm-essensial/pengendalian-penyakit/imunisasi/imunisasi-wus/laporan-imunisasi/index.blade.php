@extends('admin.layouts.admin')
@section('content')
<a href="{{ route('imunisasi-wus.index') }}" class="btn btn-danger mb-2"><i class="fas fa-arrow-left"></i> Kembali</a>
@if ($linkedJenis >= $totalJenis)
<div class="alert alert-warning">
    <h4>
        <span class="badge badge-warning mr-3">
            <i class="flaticon-alarm" style="font-size: 24px;"></i>
        </span>
        Semua jenis imunisasi telah dibuatkan laporan!
    </h4>
</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data Imunisasi Wanita Usia Subur</h3>
            @if ($linkedJenis >= $totalJenis)
                <div class="dropdown show">
                    <button disabled href="{{ route('imunisasi-wus.laporan.create', ['idSasaran'=>$sasaran->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            @else
                <div class="dropdown show">
                    <a href="{{ route('imunisasi-wus.laporan.create', ['idSasaran'=>$sasaran->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Jumlah Sasaran</th>
                        <th>Jenis Imunisasi</th>
                        <th>Jumlah Terlaksana</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            {{-- {{ dd($item) }} --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaDesa }}</td>
                            <td>{{ $item->jumlahSasaran }}</td>
                            <td>{{ $item->namaImunisasi }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>
                                <a href="{{ route('imunisasi-wus.laporan.edit', ['idSasaran'=>$sasaran->id, 'id'=>$item->idLaporan]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" data-href="{{ route('imunisasi-wus.laporan.delete', ['idSasaran' => $sasaran->id, 'id'=>$item->idLaporan]) }}" id="deleteConfirmation{{ $item->idLaporan }}" class="btn btn-sm btn-danger">Delete</a>
                                {{-- Delete Method --}}
                                <script>
                                    $("#deleteConfirmation"+{{$item->idLaporan}}).click(function () {
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
