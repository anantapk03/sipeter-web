@extends('admin.layouts.admin')
@section('content')
    <a href="{{route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')}}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    @if ($imunisasi->isEmpty())
    <div class="alert alert-success">
        <h4>
            <span class="badge badge-success mr-3">
                <i class="flaticon-success" style="font-size: 24px;"></i>
            </span>
            Semua jenis imunisasi telah dilaporkan
        </h4>
    </div>       
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Laporan Imunisasi Bayi Desa {{$sasaran->desa->namaDesa}} Bulan {{\App\helpers\MonthHelper::getMonth($sasaran->bulan)}}</h3>
                <div class="dropdown show">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('P2-Laporan-Imunisasi-create', ['id'=>$sasaran->id])}}"><i class="fas fa-plus-circle"></i> Tambah Laporan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-bpdy">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Imunisasi</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jenis Imunisasi</th>
                            <th>Laki-laki</th>
                            <th>Perempuan</th>
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
                                    {{$item->jenisImunisasi->namaImunisasi}}
                                </td>
                                <td>
                                    {{$item->jumlah_laki}}
                                </td>
                                <td>
                                    {{$item->jumlah_perempuan}}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"><i class="fas fa-eye"></i> Detail</a>
                                    {{-- Modal start --}}
                                    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLongTitle">Laporan Imunisasi {{$item->jenisImunisasi->namaImunisasi}} {{$sasaran->desa->namaDesa}} </h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table mt-3">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="col">Deskripsi</th>
                                                                <td>:</td>
                                                                <td>{{ $item->deskripsi}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Total Jumlah</th>
                                                                <td>:</td>
                                                                <td> {{$item->jumlah_perempuan + $item->jumlah_laki}} </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('P2-Laporan-Imunisasi-edit', ['id'=>$item->idSasaran, 'idLaporan'=>$item->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> edit</a>
                                    <a href="#" id="deleteConfirmation{{$item->id}}" data-href="{{route('P2-Laporan-Imunisasi-destroy', ['id'=>$item->idSasaran, 'idLaporan'=>$item->id])}}" data-name="Laporan Imunisasi {{$item->jenisImunisasi->namaImunisasi}}" class="btn btn-sm btn-danger mr-2 mt-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
                                    {{-- Start delete confirmation --}}
                                    <script>
                                        $("#deleteConfirmation"+{{$item->id}}).click(function () {
                                            swal({
                                                title: 'Peringatan!',
                                                text: "Data "+$(this).data('name')+" Akan Dihapus",
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
                                    {{-- End of delete confirmation --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection