@extends('admin.layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Data UKBM</h3>
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" style="margin-left: 73%" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-list"></i> Menu
            </button>
            <style>
                .dropdown-toggle::after {
                    display: none;
                }
            </style>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('ukbm.jenis.index') }}"><i class="fas fa-database" style="margin-right: 5%"></i>Jenis UKBM</a>
                <a class="dropdown-item" href="{{ route('ukbm.pencatatan-ukbm.report') }}"><i class="fas fa-database" style="margin-right: 5%"></i>Pencatatan UKBM</a>
            </div>
            <a class="btn btn-sm btn-success" href="{{ route('ukbm.data-ukbm.create') }}"><i class="fas fa-plus"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables2" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Desa</th>
                        <th>Jenis UKBM</th>
                        <th>Nama UKBM</th>
                        <th>Status</th>
                        {{-- <th>Alamat UKBM</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataUkbm as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namaDesa }}</td>
                            <td>{{ $item->jenisUkbm }}</td>
                            <td>{{ $item->namaUkbm }}</td>
                            <td>
                                @if ($item->status == 'active')
                                    <a href="{{ route('ukbm.data-ukbm.show', $item->id) }}" class="badge badge-success" name="btnActive"><i class="fas fa-toggle-on"></i>  Active</a>
                                    @method('POST')
                                @else
                                    <a href="{{ route('ukbm.data-ukbm.show', $item->id) }}" class="badge badge-danger" name="btnInactive"><i class="fas fa-toggle-off"></i>  Inactive</a>
                                @endif
                            </td>
                            {{-- <td>{{ $item->alamatUkbm }}</td> --}}
                            <td>
                                <div class="m-2">
                                    <a href="#" class="btn btn-sm btn-info" data-target="#exampleModalCenter{{$item->id}}" data-toggle="modal"> <i class="fas fa-info"></i> Info</a>
                                    <!-- Modal Info -->
                                    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Data UKBM</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mt-3">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col">No</th>
                                                            <td>:</td>
                                                            <td>{{ $loop->iteration }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Nama Desa</th>
                                                            <td>:</td>
                                                            <td> {{$item->namaDesa}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jenis UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->jenisUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Nama UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->namaUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Alamat UKBM</th>
                                                            <td>:</td>
                                                            <td> {{$item->alamatUkbm}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Sumber Pembiayaan</th>
                                                            <td>:</td>
                                                            <td> {{$item->sumberPembiayaan}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Kegiatan UKBM</th>
                                                            <td>:</td>
                                                            <td>
                                                                @foreach (json_decode($item->kegiatanUkbm) as $items)
                                                                <ul>
                                                                    <li> {{$items}} </li>
                                                                </ul>
                                                                @endforeach
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jumlah Kader</th>
                                                            <td>:</td>
                                                            <td> {{$item->jumlahKader}} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">Jumlah Kader yang dilatih</th>
                                                            <td>:</td>
                                                            <td> {{$item->jumlahKaderDilatih}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="#" class="btn btn-warning">Edit Data</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Info -->
                                    <a class="btn btn-sm btn-warning" href="{{ route('ukbm.data-ukbm.edit', $item->id) }}"><i class="fas fa-edit"></i>  Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('promkes.show.activity') }}" class="btn btn-warning" style="margin-left: 1%">Kembali</a>
        </div>
    </div>
</div>
@endsection
